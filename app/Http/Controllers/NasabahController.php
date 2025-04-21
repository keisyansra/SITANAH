<?php

namespace App\Http\Controllers;

use App\Models\NasabahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Cast\Object_;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class NasabahController extends Controller
{
    //menampilkan halaman awal
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Nasabah',
            'list' => ['Home', 'Nasabah']
        ];

        $page = (object) [
            'title' => 'Daftar nasabah yang terdaftar dalam sistem'
        ];

        $activeMenu = 'nasabah'; //set menu yang sedang aktif
        $nasabah = NasabahModel::all(); // ambil data admin untuk fitur admin
        return view('nasabah.index', ['breadcrumb' => $breadcrumb, 'page' => $page,'nasabah' => $nasabah, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request) {
        $nasabah = NasabahModel::select('id_nasabah','kode_nasabah', 'nama_nasabah', 'alamat_nasabah', 'telp_nasabah', 'nama_kerabat_nasabah', 'telp_kerabat_nasabah');

        // Filter data user berdasarkan admin_id
        if ($request->id_nasabah) {
            $nasabah->where('id_nasabah',$request->id_nasabah);
        }

        return DataTables::of($nasabah)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom:DT_RowIndex)
        ->addColumn('aksi', function ($nasabah) { // menambahkan kolom aksi
            $btn = '<button onclick="modalAction(\''.url('/nasabah/' . $nasabah->id_nasabah .
            '/show').'\')" class="btn btn-info btn-sm">Detail</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/nasabah/' . $nasabah->id_nasabah .
            '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/nasabah/' . $nasabah->id_nasabah .
            '/delete').'\')" class="btn btn-danger btn-sm">Hapus</button> ';

            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function show(string $id) {
        $nasabah = NasabahModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Nasabah',
            'list' => ['Home', 'Nasabah', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Nasabah'
        ];

        $activeMenu = 'nasabah'; // set menu yang sedang aktif

        return view('nasabah.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'nasabah' => $nasabah,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create() {
        $nasabah = NasabahModel::select('id_nasabah','kode_nasabah', 'nama_nasabah', 'alamat_nasabah',
        'telp_nasabah', 'nama_kerabat_nasabah', 'telp_kerabat_nasabah')->get();
        return view('nasabah.create') ->with('nasabah', $nasabah);
    }

    public function store(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_nasabah'     => 'required|string|unique:t_lokasi,kode_lokasi',
                'nama_nasabah' => 'required|string',
                'alamat_nasabah' => 'required|string|min:5',
                'telp_nasabah' => 'required|string|min:10',
                'nama_kerabat_nasabah' => 'required|string|min:5',
                'telp_kerabat_nasabah' => 'required|string|min:10',
            ];
        
            $validator = Validator::make($request->all(), $rules);
        
            if($validator->fails()){
                return response()->json([
                    'status'  => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField'=> $validator->errors(), // pesan error validasi
                ]);
            }
        
            NasabahModel::create($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data nasabah berhasil disimpan'
            ]);
        }
        return redirect('/');
    }  
        
    //menampilkan halaman form edit user ajax
    public function edit(string $id) {
        $nasabah = NasabahModel::find($id);
        return view('nasabah.edit', ['nasabah' => $nasabah]);
    }

    public function update(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_nasabah'     => 'required|string|unique:t_lokasi,kode_lokasi',
                'nama_nasabah' => 'required|string',
                'alamat_nasabah' => 'required|string|min:5',
                'telp_nasabah' => 'required|string|min:10',
                'nama_kerabat_nasabah' => 'required|string|min:5',
                'telp_kerabat_nasabah' => 'required|string|min:10'
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

            $check = NasabahModel::find($id);
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
        $nasabah = NasabahModel::find($id);
        return view('nasabah.confirm', ['nasabah' => $nasabah]);
    }

    public function delete(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $nasabah = NasabahModel::find($id);
            if ($nasabah) {
                $nasabah->delete();
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
        return redirect('/nasabah');
    }

    public function destroy(string $id) {
        $check = NasabahModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/nasabah')->with('error', 'Data nasabah tidak ditemukan');
        }

        try {
            NasabahModel::destroy($id); // Hapus data user

            return redirect('/nasabah')->with('success', 'Data nasabah berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/nasabah')->with('error', 'Data nasabah gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
