<?php

namespace App\Http\Controllers;

use App\Models\AtkTransaksi;
use App\Models\MasterATK;
use App\Models\TransaksiATK;
use Illuminate\Http\Request;

class AtkController extends Controller
{
    // Admin
    public function dashboard() {
        return view('admin.dashboard');
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

        $urutan = AtkTransaksi::max('id') ?? 0 + 1;

        return view('admin.atk.transaksi-create', compact('items', 'month', 'year', 'urutan'));
    }

    // User
    public function userDashboard() {
        return view('user.dashboard');
    }
}
