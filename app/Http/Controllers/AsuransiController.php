<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asuransi;
use App\User;

class AsuransiController extends Controller
{
    public function index()
    {
        $asuransi = Asuransi::where('users_id', auth()->user()->id)->get();
        return view('dashboard.asuransi.index', ['asuransi' => $asuransi]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_asuransi' => 'required|min:3',
            'kategori' => 'required',
            'tanggal_asuransi' => 'required',
            'nominal' => 'required|numeric',
            'periode' => 'required',
            'keterangan' => 'required'
        ]);
        $asuransi = new Asuransi;
        $asuransi->users_id = auth()->user()->id;
        $asuransi->nama_asuransi = $request->nama_asuransi;
        $asuransi->kategori = $request->kategori;
        $asuransi->tanggal_asuransi = $request->tanggal_asuransi;
        $asuransi->nominal = $request->nominal;
        $asuransi->tanggal_target = $request->tanggal_target;
        $asuransi->keterangan = $request->keterangan;
        $asuransi->save();

        $user = User::find(auth()->user()->id);
        // $saldo_baru = $request->jumlah_pemasukan + $user->saldo;

        // User::where('id', auth()->user()->id)
        //     ->update([
        //         'saldo' => $saldo_baru,
        //         'total_pemasukan' => $total_pemasukan_baru
        //     ]);

        return redirect('/asuransi')->with('status', 'Sukses Tambah Asuransi');
    }

    public function delete($id)
    {
        $asuransi_data = Asuransi::find($id);
        $user_data = User::find($asuransi_data->users_id);
        $total_asuransi_baru = $user_data->total_asuransi - $asuransi_data->nominal;
        $saldo_baru = $user_data->saldo - $asuransi_data->nominal;
        // User::where('id', auth()->user()->id)
        //     ->update([
        //         'saldo' => $saldo_baru,
        //         'total_pemasukan' => $total_pemasukan_baru
        //     ]);
        $asuransi_data->delete();

        return redirect('/asuransi')->with('status', 'Data Asuransi Sukses Dihapus');
    }

    public function edit($id)
    {
        $asuransi = Asuransi::find($id);
        return view('dashboard.asuransi.edit', ['asuransi' => $asuransi]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_asuransi' => 'required|min:3',
            'kategori' => 'required',
            'tanggal_asuransi' => 'required',
            'nominal' => 'required|numeric',
            'periode' => 'required',
            'keterangan' => 'required'
        ]);

        $asuransi = Asuransi::find($id);
        $asuransi->nama_asuransi = $request->nama_asuransi;
        $asuransi->kategori = $request->kategori;
        $asuransi->tanggal_asuransi = $request->tanggal_asuransi;
        $asuransi->nominal = $request->nominal;
        $asuransi->tanggal_target = $request->tanggal_target;
        $asuransi->keterangan = $request->keterangan;
        $asuransi->save();

        return redirect('/asuransi')->with('status', 'Data Asuransi Sukses Diubah');
    }

    public function filter(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $asuransi = Asuransi::where('users_id', auth()->user()->id)->get();
            return view('dashboard.asuransi.filter', ['asuransi' => $asuransi]);
        } else {
            $asuransi = Asuransi::whereBetween('tanggal_asuransi', [$request->startdate, $request->enddate])
                ->where('users_id', auth()->user()->id)
                ->get();
            return view('dashboard.asuransi.filter', ['asuransi' => $asuransi, 'startdate' => $request->startdate, 'enddate' => $request->enddate]);
        }
    }

    public function print(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $asuransi = Asuransi::where('users_id', auth()->user()->id)->get();
        } else {
            $asuransi = Asuransi::whereBetween('tanggal_asuransi', [$request->startdate, $request->enddate])
                ->where('users_id', auth()->user()->id)
                ->get();
        }
        return view('dashboard.asuransi.report', ['asuransi' => $asuransi]);
    }
}
