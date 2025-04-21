<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LokasiModel;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Object_;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    //menampilkan halaman awal
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Lokasi Tanah Makam',
            'list' => ['Home', 'Lokasi']
        ];

        $page = (object) [
            'title' => 'Daftar lokasi tanah makam'
        ];

        $activeMenu = 'lokasi'; //set menu yang sedang aktif
        $lokasi = LokasiModel::all(); // ambil data admin untuk fitur admin
        return view('lokasi.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'lokasi' => $lokasi, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request) {
        $lokasi = LokasiModel::select(
            'id_lokasi','kode_lokasi', 'alamat_lokasi',
            'kelurahan_lokasi', 'kecamatn_lokasi', 
            'kota_kab_lokasi', 'provinsi_lokasi'
        );

        // Filter data user berdasarkan admin_id
        if ($request->id_lokasi) {
            $Lokasi->where('id_lokasi',$request->id_lokasi);
        }

        return DataTables::of($lokasi)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom:DT_RowIndex)
        ->addColumn('aksi', function ($lokasi) { // menambahkan kolom aksi
            $btn = '<button onclick="modalAction(\''.url('/lokasi/' . $lokasi->id_lokasi .
            '/show').'\')" class="btn btn-info btn-sm">Detail</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/lokasi/' . $lokasi->id_lokasi .
            '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/lokasi/' . $lokasi->id_lokasi .
            '/delete').'\')" class="btn btn-danger btn-sm">Hapus</button> ';

            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function show(string $id) {
        $lokasi = LokasiModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Lokasi Tanah Makam',
            'list' => ['Home', 'Lokasi', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Lokasi Tanah Makam'
        ];

        $activeMenu = 'lokasi'; // set menu yang sedang aktif

        return view('lokasi.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'lokasi' => $lokasi,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create() {
        $lokasi = LokasiModel::select(
            'id_lokasi','kode_lokasi', 'alamat_lokasi',
            'kelurahan_lokasi', 'kecamatn_lokasi', 
            'kota_kab_lokasi', 'provinsi_lokasi'
        )->get();
        return view('lokasi.create') ->with('lokasi', $lokasi);
    }

    public function store(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_lokasi'     => 'required|string|min:2|unique:t_lokasi,kode_lokasi',
                'kelurahan_lokasi'=> 'required|string|min:2',
                'alamat_lokasi'   => 'required|string|min:2',
                'kecamatn_lokasi' => 'required|string|min:2',
                'kota_kab_lokasi' => 'required|string|min:2',
                'provinsi_lokasi' => 'required|string|min:2'
            ]; 
        
            $validator = Validator::make($request->all(), $rules);
        
            if($validator->fails()){
                return response()->json([
                    'status'  => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Gagal menyimpan data',
                    'msgField'=> $validator->errors(), // pesan error validasi
                    'error'   => $e->getMessage()
                ]);
            }
        
            LokasiModel::create($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data lokasi tanah berhasil disimpan'
            ]);
        }
        return redirect('/lokasi');
    }  
        
    //menampilkan halaman form edit user ajax
    public function edit(string $id) {
        $lokasi = LokasiModel::find($id);
        return view('lokasi.edit', ['lokasi' => $lokasi]);
    }

    public function update(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_lokasi'     => 'required|string|min:2|unique:t_lokasi,kode_lokasi',
                'kelurahan_lokasi'=> 'required|string|min:2',
                'alamat_lokasi'   => 'required|string|min:2',
                'kecamatn_lokasi' => 'required|string|min:2',
                'kota_kab_lokasi' => 'required|string|min:2',
                'provinsi_lokasi' => 'required|string|min:2'
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

            $check = LokasiModel::find($id);
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
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm(string $id) {
        $lokasi = LokasiModel::find($id);
        return view('lokasi.confirm', ['lokasi' => $lokasi]);
    }

    public function delete(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $lokasi = LokasiModel::find($id);
            if ($lokasi) {
                $lokasi->delete();
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
        return redirect('/');
    }

    public function destroy(string $id) {
        $check = LokasiModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/lokasi')->with('error', 'Data lokasi tanah tidak ditemukan.');
        }

        try {
            LokasiModel::destroy($id); // Hapus data user

            return redirect('/lokasi')->with('success', 'Data lokasi tanah berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/lokasi')->with('error', 'Data lokasi tanah gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
