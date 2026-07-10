<?php

namespace App\Http\Controllers;

use App\Models\AtkTransaksi;
use App\Models\MasterATK;
use App\Models\TransaksiATK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AtkController extends Controller
{
    // Admin
    public function dashboard() {
        $name = Auth::user()->name;
        return view('admin.dashboard', compact('name'));
    }

    public function atkIndex() {
        $data = MasterATK::all();
        return view('admin.atk.index', compact('data'));
    }

    public function atkCreate() {
        return view('admin.atk.create');
    }

    public function atkStore(Request $request) {
        $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'satuan'        => 'required|string|max:50',
            'harga'         => 'required|integer|min:0',
            'stok_awal'     => 'required|integer|min:0',
            'keterangan'    => 'nullable|string',
        ]);

        MasterATK::create([
            'nama_barang'   => $request->nama_barang,
            'satuan'        => $request->satuan,
            'harga'         => $request->harga,
            'stok_awal'     => $request->stok_awal,
            'stok_sekarang' => $request->stok_awal,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('admin.atk')->with('success', 'Data ATK berhasil ditambahkan!');
    }

    public function atkEdit($id) {
        $data = MasterATK::findOrFail($id);

        return view('admin.atk.edit', compact('data'));
    }

    public function atkUpdate(Request $request, $id) {
        $request->validate([
            'nama_barang'   => 'required|string|max:255',
            'satuan'        => 'required|string|max:50',
            'harga'         => 'required|integer|min:0',
            'stok_awal'     => 'required|integer|min:0',
            'keterangan'    => 'nullable|string',
        ]);

        $data = MasterATK::findOrFail($id);

        $data->update([
            'nama_barang'   => $request->nama_barang,
            'satuan'        => $request->satuan,
            'harga'         => $request->harga,
            'stok_awal'     => $request->stok_awal,
            'stok_sekarang' => $request->stok_awal,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('admin.atk')->with('success', 'Data ATK berhasil diperbarui!');
    }

    public function atkDestroy($id) {
        $data = MasterATK::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.atk')->with('success', 'Data ATK berhasil dihapus!');
    }

    public function atkTransaksi() {
        $data = AtkTransaksi::all();
        return view('admin.atk.transaksi', compact('data'));
    }

    public function atkTransaksiCreate() {
        $items = MasterATK::all();
        $month = date('m');
        $year = date('Y');
        $urutan = (AtkTransaksi::max('id') ?? 0) + 1;

        return view('admin.atk.transaksi-create', compact('items', 'month', 'year', 'urutan'));
    }


    public function atkTransaksiStore(Request $request) {
        $request->validate([
            'id_barang'     => 'required|integer',
            'id_transaksi'  => 'required|string',
            'tipe'          => 'required|in:masuk,keluar',
            'qty'           => 'required|integer|min:1',
            'keterangan'    => 'nullable|string',
        ]);

        $masterBarang = MasterATK::findOrFail($request->id_barang);

        if($request->tipe === 'masuk') {
            $masterBarang->update([
                'stok_sekarang' => $masterBarang->stok_sekarang + $request->qty,
            ]);
            // dd($masterBarang->stok_sekarang + $request->qty);
        } else {
            $masterBarang->update([
                'stok_sekarang' => $masterBarang->stok_sekarang - $request->qty,
            ]);
            // dd($masterBarang->stok_sekarang - $request->qty);
        }

        AtkTransaksi::create([
            'id_barang'     => $request->id_barang,
            'id_user'       => Auth::id(),
            'id_transaksi'  => $request->id_transaksi,
            'tipe'          => $request->tipe,
            'qty'           => $request->qty,
            'harga_satuan'  => $masterBarang->harga,
            'total_harga'   => $request->qty * $masterBarang->harga,
            'keterangan'    => $request->keterangan,
        ]);

        return redirect()->route('admin.atk.transaksi')->with('success', 'Transaksi ATK berhasil ditambahkan!');
        // dd(Auth::id());
    }

    // User
    public function userDashboard() {
        return view('user.dashboard');
    }
}
