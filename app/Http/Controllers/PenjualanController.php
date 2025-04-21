<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\NasabahModel;
use App\Models\TanahModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Monolog\Level;
use PhpParser\Node\Expr\Cast\Object_;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    //menampilkan halaman awal
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan Tanah Makam',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar penjualan tanah makam yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan'; //set menu yang sedang aktif

        $nasabah = NasabahModel::all();
        $tanah = TanahModel::all();
        return view ('penjualan.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'nasabah' => $nasabah,  
            'tanah' => $tanah, 
            'activeMenu' => $activeMenu
        ]); 
    }

    // Ambil data user dalam bentuk json untuk datatables
    public function list(Request $request) {
        $penjualan = PenjualanModel::select(
            'id_penjualan', 'kode_penjualan', 'id_nasabah', 'id_tanah', 'pembayaran'
        )->with('nasabah')
        ->with('tanah');

        // Filter data user berdasarkan admin_id
        if ($request->id_penjualan) {
            $penjualan->where('id_penjualan',$request->id_penjualan);
        }

        return DataTables::of($penjualan)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom:DT_RowIndex)
        ->addColumn('aksi', function ($penjualan) { // menambahkan kolom aksi
            $btn = '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->id_penjualan . '/show').'\')" class="btn btn-info btn-sm">Detail</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->id_penjualan . '/edit').'\')" class="btn btn-warning btn-sm">Edit</button> ';

            $btn .= '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->id_penjualan . '/delete').'\')" class="btn btn-danger btn-sm">Hapus</button> ';

            return $btn; 
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    public function show(string $id) {
        $penjualan = PenjualanModel::with('nasabah', 'tanah')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Penjualan Tanah Makam',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Penjualan Tanah Makam'
        ];

        $activeMenu = 'penjualan'; // set menu yang sedang aktif

        return view('penjualan.show', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'penjualan' => $penjualan,
            'activeMenu' => $activeMenu
        ]);
    }

    public function create() {
        $nasabah = NasabahModel::select('id_nasabah','nama_nasabah','telp_nasabah')->get();
        $tanah = TanahModel::select('id_tanah','no_kav_tanah','harga')->get();
        return view('penjualan.create') 
        ->with('nasabah', $nasabah)
        ->with('tanah', $tanah);
    }

    public function store(Request $request) {
        // cek apakah request berupa ajax
        if($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_penjualan' => 'required|string|min:2|max:100',
                'id_nasabah' => 'required|numeric',
                'id_tanah' => 'required|numeric',
                'pembayaran' => 'required|string|min:2|max:100',
            ];
        
            $validator = Validator::make($request->all(), $rules);
        
            if($validator->fails()){
                return response()->json([
                    'status'  => false, // response status, false: error/gagal, true: berhasil
                    'message' => 'Validasi Gagal',
                    'msgField'=> $validator->errors(), // pesan error validasi
                ]);
            }
        
            PenjualanModel::create($request->all());
            return response()->json([
                'status'  => true,
                'message' => 'Data tanah makam berhasil disimpan'
            ]);
        }
        return redirect('/');
    }  
        
    //menampilkan halaman form edit user ajax
    public function edit(string $id) {
        $penjualan = PenjualanModel::find($id);

        if (!$penjualan) {
            dd("Data penjualan ID $id tidak ditemukan");
        }

        $nasabah = NasabahModel::select('id_nasabah','nama_nasabah','telp_nasabah')->get();
        $tanah = TanahModel::select('id_tanah','no_kav_tanah','harga')->get();
        return view('penjualan.edit', [
            'penjualan' => $penjualan, 
            'nasabah' => $nasabah, 
            'tanah' => $tanah
        ]);
    }

    public function update(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_penjualan' => 'required|string|min:2|max:100',
                'id_nasabah' => 'required|numeric',
                'id_tanah' => 'required|numeric',
                'pembayaran' => 'required|string|min:2|max:100',
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

            $check = PenjualanModel::find($id);
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
        $penjualan = PenjualanModel::find($id);
        return view('penjualan.confirm', ['penjualan' => $penjualan]);
    }

    public function delete(Request $request, $id) {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $penjualan = PenjualanModel::find($id);
            if ($penjualan) { 
                $penjualan->delete();
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
        return redirect('/penjualan');
    }

    public function destroy(string $id) {
        $check = PenjualanModel::find($id);
        if (!$check) { // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
            return redirect('/penjualan')->with('error', 'Data penjualan tanah makam tidak ditemukan');
        }

        try {
            TanahModel::destroy($id); // Hapus data user

            return redirect('/penjualan')->with('success', 'Data penjualantanah makam berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/penjualan')->with('error', 'Data penjualantanah makam gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
