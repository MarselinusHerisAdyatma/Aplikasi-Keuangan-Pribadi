<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pengeluaran;
use App\Pemasukan;

class AdminController extends Controller
{
    public function listuser()
    {
        $user = User::all();
        return view('dashboard.admin.listuser', ['user' => $user]);
    }

    public function manageuser($id)
    {
        $user = User::find($id);
        return view('dashboard.admin.manageuser', ['user' => $user]);
    }

    public function postmanageuser(Request $request, $id)
    {
        $this->validate($request, [
            'role' => 'required'
        ]);
        $user = User::find($id);
        $user->role = $request->role;
        $user->save();

        return redirect('/admin/listuser')->with('status', 'Sukses Edit User');
    }

    public function getUpdatedTotals($id)
    {
        // Fetch the user data based on the provided ID
        $user = User::find($id);
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
    
        // Calculate the updated saldo, total_pemasukan, and total_pengeluaran
        $totalPemasukan = Pemasukan::where('users_id', $user->id)->sum('jumlah_pemasukan');
        $totalPengeluaran = Pengeluaran::where('users_id', $user->id)->sum('jumlah_pengeluaran');
        
        // Calculate saldo as the difference between totalPemasukan and totalPengeluaran
        $saldo = $totalPemasukan - $totalPengeluaran;
    
        return response()->json([
            'saldo' => number_format($saldo, 0, ',', '.'),
            'totalPemasukan' => number_format($totalPemasukan, 0, ',', '.'),
            'totalPengeluaran' => number_format($totalPengeluaran, 0, ',', '.'),
        ]);
    }
    
}
