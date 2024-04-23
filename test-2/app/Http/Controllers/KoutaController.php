<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kouta;
use App\Models\Satuan;

class KoutaController extends Controller
{
    
    public function index()
    {
        $koutas  = Kouta::with('satuan')->get();
        $satuans = Satuan::where('status', true)->get();
        return view('kouta.index', compact('koutas','satuans'));
    }
 
    public function store(Request $request)
{
    $request->validate([
        'satuan_id' => 'required|exists:satuans,id',
        'kouta' => 'required',
        'berat' => 'required',
        'harga' => 'required',
        'cabang' => 'required',
    ]);


    $kouta = new Kouta([
        'kouta' => $request->kouta,
        'berat' => $request->berat,
        'harga' => $request->harga,
        'cabang' => $request->cabang,
    ]);

    
    $satuan = Satuan::findOrFail($request->satuan_id);

  
    $kouta->satuan()->associate($satuan);

    
    $kouta->save();

    return redirect()->route('kouta.index')->with('success', 'Data kouta berhasil ditambahkan.');
}
  
public function update(Request $request, string $id)
{
    $request->validate([
        'satuan_id' => 'required|exists:satuans,id',
        'kouta' => 'required',
        'berat' => 'required',
        'harga' => 'required',
        'cabang' => 'required',
    ]);

    $kouta = Kouta::findOrFail($id);

  
    $kouta->update([
        'kouta' => $request->kouta,
        'berat' => $request->berat,
        'harga' => $request->harga,
        'cabang' => $request->cabang,
        'satuan_id' => $request->satuan_id,
    ]);

    return redirect()->route('kouta.index')->with('success', 'Data kouta berhasil diperbarui.');
}

    // Menghapus data kouta
    public function destroy($id)
    {
        $kouta = Kouta::findOrFail($id);
        $kouta->delete();

        return redirect()->route('kouta.index')->with('success', 'Data kouta berhasil dihapus.');
    }

    public function disable($id)
{
    $kouta = Kouta::findOrFail($id);
    $kouta->status = false;
    $kouta->save();

    return redirect()->back()->with('success', 'Kouta berhasil dinonaktifkan.');
}

public function enable($id)
{
    $kouta = Kouta::findOrFail($id);
    $kouta->status = true;
    $kouta->save();

    return redirect()->back()->with('success', 'Kouta berhasil diaktifkan.');
}

}
