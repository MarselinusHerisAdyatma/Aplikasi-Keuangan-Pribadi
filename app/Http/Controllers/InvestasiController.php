<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Investasi;
use App\User;

class InvestasiController extends Controller
{
    public function index()
    {
        $investasis = Investasi::where('user_id', auth()->user()->id)->get();
        return view('dashboard.investasi.index', ['investasis' => $investasis]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'investasi' => 'required|in:beli,jual',
            'nama_investasi' => 'required|min:3',
            'nama_bank' => 'required',
            'date' => 'required',
            'time' => 'required',
            'nominal_modal' => 'required|numeric',
            'nominal_investasi' => 'required|numeric',
            'jumlah' => 'required|integer',
            'status' => 'required|in:Loss,Profit',
            'keterangan' => 'nullable',
        ]);

        $investasi = new Investasi;
        $investasi->user_id = auth()->user()->id;
        $investasi->investasi = $request->investasi;
        $investasi->nama_investasi = $request->nama_investasi;
        $investasi->nama_bank = $request->nama_bank;
        $investasi->date = $request->date;
        $investasi->time = $request->time;
        $investasi->nominal_modal = $request->nominal_modal;
        $investasi->nominal_investasi = $request->nominal_investasi;
        $investasi->jumlah = $request->jumlah;
        $investasi->status = $request->status;
        $investasi->keterangan = $request->keterangan;
        $investasi->save();

        // Update user data if necessary
        // $user = User::find(auth()->user()->id);
        // Implement your logic to update user data

        return redirect('/investasi')->with('status', 'Sukses Tambah Investasi');
    }

    public function delete($id)
    {
        $investasi = Investasi::find($id);
        // Implement your logic to update user data if necessary
        // $user = User::find($investasi->user_id);

        $investasi->delete();

        return redirect('/investasi')->with('status', 'Data Investasi Sukses Dihapus');
    }

    public function edit($id)
    {
        $investasi = Investasi::find($id);
        return view('dashboard.investasi.edit', ['investasi' => $investasi]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'investasi' => 'required|in:beli,jual',
            'nama_investasi' => 'required|min:3',
            'nama_bank' => 'required',
            'date' => 'required',
            'time' => 'required',
            'nominal_modal' => 'required|numeric',
            'nominal_investasi' => 'required|numeric',
            'jumlah' => 'required|integer',
            'status' => 'required|in:Loss,Profit',
            'keterangan' => 'nullable',
        ]);

        $investasi = Investasi::find($id);
        $investasi->investasi = $request->investasi;
        $investasi->nama_investasi = $request->nama_investasi;
        $investasi->nama_bank = $request->nama_bank;
        $investasi->date = $request->date;
        $investasi->time = $request->time;
        $investasi->nominal_modal = $request->nominal_modal;
        $investasi->nominal_investasi = $request->nominal_investasi;
        $investasi->jumlah = $request->jumlah;
        $investasi->status = $request->status;
        $investasi->keterangan = $request->keterangan;
        $investasi->save();

        // Update user data if necessary
        // $user = User::find($investasi->user_id);
        // Implement your logic to update user data

        return redirect('/investasi')->with('status', 'Sukses Update Investasi');
    }

    public function filter(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $investasis = Investasi::where('user_id', auth()->user()->id)->get();
            return view('dashboard.investasi.filter', ['investasis' => $investasis]);
        } else {
            $investasis = Investasi::whereBetween('date', [$request->startdate, $request->enddate])
                ->where('user_id', auth()->user()->id)
                ->get();
    
            return view('dashboard.investasi.filter', [
                'investasis' => $investasis,
                'startdate' => $request->startdate,
                'enddate' => $request->enddate
            ]);
        }
    }

    public function print(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $investasis = Investasi::where('user_id', auth()->user()->id)->get();
        } else {
            $investasis = Investasi::whereBetween('date', [$request->startdate, $request->enddate])
                ->where('user_id', auth()->user()->id)
                ->get();
        }
    
        return view('dashboard.investasi.report', ['investasis' => $investasis]);
    }
}
