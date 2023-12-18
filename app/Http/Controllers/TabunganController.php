<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tabungan;
use App\User;

class TabunganController extends Controller
{
    public function index()
    {
        $tabungan = Tabungan::where('users_id', auth()->user()->id)->get();
        return view('dashboard.tabungan.index', ['tabungan' => $tabungan]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_tabungan' => 'required|min:3',
            'tanggal_tabungan' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $tabungan = new Tabungan;
        $tabungan->users_id = auth()->user()->id;
        $tabungan->nama_tabungan = $request->nama_tabungan;
        $tabungan->tanggal_tabungan = $request->tanggal_tabungan;
        $tabungan->nominal = $request->nominal;
        $tabungan->keterangan = $request->keterangan;
        $tabungan->save();

        // Additional logic if needed

        return redirect('/tabungan')->with('status', 'Sukses Tambah Tabungan');
    }

    public function delete($id)
    {
        $tabungan_data = Tabungan::find($id);
        // Additional logic if needed
        $tabungan_data->delete();

        return redirect('/tabungan')->with('status', 'Data Tabungan Sukses Dihapus');
    }

    public function edit($id)
    {
        $tabungan = Tabungan::find($id);
        return view('dashboard.tabungan.edit', ['tabungan' => $tabungan]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_tabungan' => 'required|min:3',
            'tanggal_tabungan' => 'required',
            'nominal' => 'required|numeric',
            'keterangan' => 'required'
        ]);

        $tabungan = Tabungan::find($id);
        $tabungan->nama_tabungan = $request->nama_tabungan;
        $tabungan->tanggal_tabungan = $request->tanggal_tabungan;
        $tabungan->nominal = $request->nominal;
        $tabungan->keterangan = $request->keterangan;
        $tabungan->save();

        return redirect('/tabungan')->with('status', 'Data Tabungan Sukses Diubah');
    }

    public function filter(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $tabungan = Tabungan::where('users_id', auth()->user()->id)->get();
            return view('dashboard.tabungan.filter', ['tabungan' => $tabungan]);
        } else {
            $tabungan = Tabungan::whereBetween('tanggal_tabungan', [$request->startdate, $request->enddate])
                ->where('users_id', auth()->user()->id)
                ->get();
            return view('dashboard.tabungan.filter', ['tabungan' => $tabungan, 'startdate' => $request->startdate, 'enddate' => $request->enddate]);
        }
    }

    public function print(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $tabungan = Tabungan::where('users_id', auth()->user()->id)->get();
        } else {
            $tabungan = Tabungan::whereBetween('tanggal_tabungan', [$request->startdate, $request->enddate])
                ->where('users_id', auth()->user()->id)
                ->get();
        }
        return view('dashboard.tabungan.report', ['tabungan' => $tabungan]);
    }

}
