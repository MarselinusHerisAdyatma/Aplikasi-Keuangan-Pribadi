<?php

namespace App\Http\Controllers;

use App\User;
use App\Pengeluaran;
use App\Pemasukan;

use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;

class DashboardController extends Controller
{
    public function index()
    {
        $data_user = User::find(auth()->user()->id);

        // Fetch income data
        $incomeData = $this->getIncomeChartData();
        $expenseData = $this->getExpenseChartData();

        $data_pengeluaran = Pengeluaran::where('users_id', auth()->user()->id)->groupBy('kategori')
            ->selectRaw('sum(jumlah_pengeluaran) as sum, kategori')
            ->pluck('sum', 'kategori')->toArray();

        $kategori_pengeluaran = array_keys($data_pengeluaran);
        $data_pengeluaran_by_kategori = array_map('intval', array_values($data_pengeluaran));

        $data_pemasukan = Pemasukan::where('users_id', auth()->user()->id)->groupBy('kategori')
        ->selectRaw('sum(jumlah_pemasukan) as sum, kategori')
        ->pluck('sum', 'kategori')->toArray();

        $kategori_pemasukan = array_keys($data_pemasukan);
        $data_pemasukan_by_kategori = array_map('intval', array_values($data_pemasukan));
    
        return view('dashboard.user.dashboard', [
            'user' => $data_user,
            'kategori_pengeluaran' => $kategori_pengeluaran,
            'data_pengeluaran_by_kategori' => $data_pengeluaran_by_kategori,
            'kategori_pemasukan' => $kategori_pemasukan,
            'data_pemasukan_by_kategori' => $data_pemasukan_by_kategori,
            'incomeData' => $incomeData, // Add this line to pass income data
            'expenseData' => $expenseData, // Add this line to pass expense data
        ]);
    }

    public function getIncomeChartData()
    {
        $income = Pemasukan::where('users_id', auth()->user()->id)->get();
        $dates = $income->pluck('tanggal_pemasukan');
        $amounts = $income->pluck('jumlah_pemasukan');

        return compact('dates', 'amounts');
    }

    public function getExpenseChartData()
    {
        $expenses = Pengeluaran::where('users_id', auth()->user()->id)->get();
        $dates = $expenses->pluck('tanggal_pengeluaran');
        $amounts = $expenses->pluck('jumlah_pengeluaran');
    
        return compact('dates', 'amounts');
    }
    
    public function getUpdatedTotals()
    {
        // Fetch the user data
        $user = User::find(auth()->user()->id);
    
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
