<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AkunKeuangan; // Make sure to use the correct model for AkunKeuangan

class AkunKeuanganController extends Controller
{
    public function index()
    {
        $akunKeuangans = AkunKeuangan::all(); // Assuming you want to retrieve all records
        return view('dashboard.akun_keuangan.index', ['akunKeuangans' => $akunKeuangans]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_rekening' => 'required|min:3',
            'no_rekening' => 'required|unique:akun_keuangan',
        ]);

        $akunKeuangan = new AkunKeuangan;
        $akunKeuangan->nama_rekening = $request->nama_rekening;
        $akunKeuangan->no_rekening = $request->no_rekening;
        $akunKeuangan->save();

        return redirect('/akun_keuangan')->with('status', 'Sukses Tambah Akun Keuangan');
    }

    public function delete($id)
    {
        $akunKeuangan = AkunKeuangan::find($id);
        $akunKeuangan->delete();

        return redirect('/akun_keuangan')->with('status', 'Data Akun Keuangan Sukses Dihapus');
    }

    public function edit($id)
    {
        $akunKeuangan = AkunKeuangan::find($id);
        return view('dashboard.akun_keuangan.edit', ['akunKeuangan' => $akunKeuangan]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_rekening' => 'required|min:3',
            'no_rekening' => 'required|unique:akun_keuangan,no_rekening,' . $id,
        ]);

        $akunKeuangan = AkunKeuangan::find($id);
        $akunKeuangan->nama_rekening = $request->nama_rekening;
        $akunKeuangan->no_rekening = $request->no_rekening;
        $akunKeuangan->save();

        return redirect('/akun_keuangan')->with('status', 'Data Akun Keuangan Sukses Diubah');
    }

    public function filter(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $akunKeuangans = AkunKeuangan::all();
            return view('dashboard.akun_keuangan.filter', ['akunKeuangans' => $akunKeuangans]);
        } else {
            $akunKeuangans = AkunKeuangan::whereBetween('created_at', [$request->startdate, $request->enddate])
                ->get();
            return view('dashboard.akun_keuangan.filter', ['akunKeuangans' => $akunKeuangans, 'startdate' => $request->startdate, 'enddate' => $request->enddate]);
        }
    }

    public function print(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $akunKeuangans = AkunKeuangan::all();
        } else {
            $akunKeuangans = AkunKeuangan::whereBetween('created_at', [$request->startdate, $request->enddate])
                ->get();
        }

        return view('dashboard.akun_keuangan.report', ['akunKeuangans' => $akunKeuangans]);
    }
}
