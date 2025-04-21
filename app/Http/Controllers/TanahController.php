<?php

namespace App\Http\Controllers;

use App\Models\TanahModel;
use App\Models\LokasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Monolog\Level;
use PhpParser\Node\Expr\Cast\Object_;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TanahController extends Controller
{
    //menampilkan halaman awal
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Tanah Makam',
            'list' => ['Home', 'Tanah']
        ];

        $page = (object) [
            'title' => 'Daftar tanah makam yang terdaftar dalam sistem'
        ];

        $activeMenu = 'tanah'; //set menu yang sedang aktif
        // $tanah = TanahModel::all(); // ambil data admin untuk fitur admin
        $lokasi = LokasiModel::all();
        return view('tanah.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'lokasi' => $lokasi, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request) {
        $tanah = TanahModel::select(
            'id_tanah','kode_tanah','id_lokasi',
            'no_kav_tanah','panjang_tanah','lebar_tanah','harga'
        )->with('lokasi');

        // Filter data user berdasarkan admin_id
        if ($request->id_lokasi) {
            $tanah->where('id_lokasi',$request->id_lokasi);
        }

        return DataTables::of($tanah)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom:DT_RowIndex)
        ->addColumn('aksi', function ($tanah) { // menambahkan kolom aksi
            $btn = '<button onclick="modalAction(\''.url('/tanah/' . $tanah->id_tanah .
            '/show').'\')" class="btn btn-info btn-sm">Detail</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/tanah/' . $tanah->id_tanah .
            '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/tanah/' . $tanah->id_tanah .
            '/delete').'\')" class="btn btn-danger btn-sm">Hapus</button> ';

            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function show(string $id) {
        $tanah = TanahModel::with('lokasi')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Tanah Makam',
            'list' => ['Home', 'Tanah', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Tanah Makam'
        ];

        $activeMenu = 'tanah'; // set menu yang sedang aktif

        return view('tanah.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'tanah' => $tanah,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create() {
        $tanah = TanahModel::select(
            'id_tanah', 'kode_tanah', 
            'no_kav_tanah', 
            'panjang_tanah', 
            'lebar_tanah', 
            'harga'
        )->get();
        $lokasi = LokasiModel::select(
            'id_lokasi',
            'alamat_lokasi',
            'kota_kab_lokasi'
        )->get();
        return view('tanah.create') ->with('lokasi', $lokasi);
    }

    public function store(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_tanah' => 'required|string|min:2|max:100',
                'id_lokasi' => 'required|numeric',
                'no_kav_tanah' => 'required|string|min:2|max:100',
                'panjang_tanah' => 'required|string|min:2|max:100',
                'lebar_tanah' => 'required|string|min:2|max:100',
                'harga' => 'required|string|min:2|max:100',
            ];
        
            $validator = Validator::make($request->all(), $rules);
        
            if($validator->fails()){
                return response()->json([
                    'status'  => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField'=> $validator->errors(), // pesan error validasi
                ]);
            }
        
            TanahModel::create([
                'kode_tanah' => $request->kode_tanah,
                'id_lokasi' => $request->id_lokasi,
                'no_kav_tanah' => $request->no_kav_tanah,
                'panjang_tanah' => $request->panjang_tanah,
                'lebar_tanah' => $request->lebar_tanah,
                'harga' => $request->harga,
            ]);
            return response()->json([
                'status'  => true,
                'message' => 'Data tanah makam berhasil disimpan'
            ]);
        }
        return redirect('/');
    }  
        
    //menampilkan halaman form edit user ajax
    public function edit(string $id) {
        $tanah = TanahModel::find($id);
        $lokasi = LokasiModel::select('id_lokasi','alamat_lokasi','kota_kab_lokasi')->get();
        return view('tanah.edit', ['tanah' => $tanah, 'lokasi' => $lokasi]);
    }

    public function update(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_tanah' => 'required|string|min:2|max:100',
                'id_lokasi' => 'required|numeric',
                'no_kav_tanah' => 'required|string|min:2|max:100',
                'panjang_tanah' => 'required|string|min:2|max:100',
                'lebar_tanah' => 'required|string|min:2|max:100',
                'harga' => 'required|string|min:2|max:100',
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                    return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }

            $check = TanahModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } 
            else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak gagal diupdate'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm(string $id) {
        $tanah = TanahModel::find($id);
        return view('tanah.confirm', ['tanah' => $tanah]);
    }

    public function delete(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $tanah = TanahModel::find($id);
            if ($tanah) {
                $tanah->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/tanah');
    }

    public function destroy(string $id) {
        $check = TanahModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/tanah')->with('error', 'Data tanah makam tidak ditemukan');
        }

        try {
            TanahModel::destroy($id); // Hapus data user

            return redirect('/tanah')->with('success', 'Data tanah makam berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/tanah')->with('error', 'Data tanah makam gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
