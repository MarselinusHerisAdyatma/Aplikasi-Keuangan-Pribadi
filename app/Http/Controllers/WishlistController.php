<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Pemasukan::where('users_id', auth()->user()->id)->get();
        return view('dashboard.wishlist.index', ['wishlist' => $wishlist]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'nama_wishlist' => 'required|min:3',
            'kategori' => 'required',
            'tanggal_wishlist' => 'required',
            'nominal' => 'required|numeric'
            'tanggal_target' => 'required',
            'keterangan' => 'required'
        ]);
        $wishlist = new Wishlist;
        $wishlist->users_id = auth()->user()->id;
        $wishlist->nama_wishlist = $request->nama_wishlist;
        $wishlist->kategori = $request->kategori;
        $wishlist->tanggal_wishlist = $request->tanggal_wishlist;
        $wishlist->nominal = $request->nominal;
        $wishlist->tanggal_target = $request->tanggal_target;
        $wishlist->keterangan = $request->keterangan;
        $wishlist->save();

        $user = User::find(auth()->user()->id);
        // $saldo_baru = $request->jumlah_pemasukan + $user->saldo;

        // User::where('id', auth()->user()->id)
        //     ->update([
        //         'saldo' => $saldo_baru,
        //         'total_pemasukan' => $total_pemasukan_baru
        //     ]);

        return redirect('/wishlist')->with('status', 'Sukses Tambah Wishlist');
    }

    public function delete($id)
    {
        $wishlist_data = Wishlist::find($id);
        $user_data = User::find($wishlist_data->users_id);
        $total_wishlist_baru = $user_data->total_wishlist - $wishlist_data->nominal;
        $saldo_baru = $user_data->saldo - $wishlist_data->nominal;
        // User::where('id', auth()->user()->id)
        //     ->update([
        //         'saldo' => $saldo_baru,
        //         'total_pemasukan' => $total_pemasukan_baru
        //     ]);
        $wishlist_data->delete();

        return redirect('/wishlist')->with('status', 'Data Wishlist Sukses Dihapus');
    }

    public function edit($id)
    {
        $wishlist = Wishlist::find($id);
        return view('dashboard.wishlist.edit', ['wishlist' => $wishlist]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_wishlist' => 'required|min:3',
            'kategori' => 'required',
            'tanggal_wishlist' => 'required',
            'nominal' => 'required|numeric'
            'tanggal_target' => 'required',
            'keterangan' => 'required'
        ]);

        $wishlist = Wishlist::find($id);
        $wishlist->nama_wishlist = $request->nama_wishlist;
        $wishlist->kategori = $request->kategori;
        $wishlist->tanggal_wishlist = $request->tanggal_wishlist;
        $wishlist->nominal = $request->nominal;
        $wishlist->tanggal_target = $request->tanggal_target;
        $wishlist->keterangan = $request->keterangan;
        $wishlist->save();

        return redirect('/wishlist')->with('status', 'Data Wishlist Sukses Diubah');
    }

    public function filter(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $wishlist = Wishlist::where('users_id', auth()->user()->id)->get();
            return view('dashboard.wishlist.filter', ['wishlist' => $wishlist]);
        } else {
            $wishlist = Wishlist::whereBetween('tanggal_wishlist', [$request->startdate, $request->enddate])
                ->where('users_id', auth()->user()->id)
                ->get();
            return view('dashboard.wishlist.filter', ['wishlist' => $wishlist, 'startdate' => $request->startdate, 'enddate' => $request->enddate]);
        }
    }

    public function print(Request $request)
    {
        if (!$request->startdate && !$request->enddate) {
            $wishlist = Wishlist::where('users_id', auth()->user()->id)->get();
        } else {
            $wishlist = Wishlist::whereBetween('tanggal_wishlist', [$request->startdate, $request->enddate])
                ->where('users_id', auth()->user()->id)
                ->get();
        }
        return view('dashboard.wishlist.report', ['wishlist' => $wishlist]);
    }
}
