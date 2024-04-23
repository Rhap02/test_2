<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::all();
        return view('satuan.index', compact('satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required',
            'desc' => 'required',
        ]);

        Satuan::create([
            'satuan' => $request->satuan,
            'desc' => $request->desc,
        ]);

        return redirect()->back()->with('success', 'Satuan unit berhasil dibuat.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'satuan' => 'required',
            'desc' => 'required',
        ]);

        $satuan = Satuan::findOrFail($id);
        $satuan->update([
            'satuan' => $request->satuan,
            'desc' => $request->desc,
        ]);

        return redirect()->back()->with('success', 'Satuan unit berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->delete();

        return redirect()->back()->with('success', 'Satuan unit berhasil dihapus.');
    }

    public function disable($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->status = false;
        $satuan->save();

        return redirect()->back()->with('success', 'Satuan unit berhasil dinonaktifkan.');
    }

    public function enable($id)
    {
        $satuan = Satuan::findOrFail($id);
        $satuan->status = true;
        $satuan->save();

        return redirect()->back()->with('success', 'Satuan unit berhasil diaktifkan.');
    }
}
