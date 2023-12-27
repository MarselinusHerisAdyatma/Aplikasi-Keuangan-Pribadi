<?php

namespace App\Http\Controllers;

use App\User;
use App\Pengeluaran;
use App\Pemasukan;
use App\Tabungan;
use App\Hutang;
use App\Asuransi;
use App\Wishlist;
use App\Investasi;
use App\AkunKeuangan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;

class DashboardController extends Controller
{
    public function index()
    {
        $data_user = User::find(auth()->user()->id);

        $incomeData = $this->getIncomeChartData();
        $expenseData = $this->getExpenseChartData();
        $incomeDataCategories = $this->getIncomeChartCategoriesData();
        $expenseDataCategories = $this->getExpenseChartCategoriesData();
        $insurances = $this->getInsurance();
        $wishlists = $this->getWishlist();
        $investasiData = $this->getInvestasiChartData();
        $accounts = $this->getAccount();

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
            'incomeData' => $incomeData, 
            'expenseData' => $expenseData, 
            'incomeDataCategories' => $incomeDataCategories,
            'expenseDataCategories' => $expenseDataCategories,
            'insurances' => $insurances,
            'wishlists' => $wishlists,
            'investasiData' => $investasiData,
            'accounts' => $accounts,
        ]);
    }

    public function getIncomeChartData()
    {
        $income = Pemasukan::where('users_id', auth()->user()->id)
            ->orderBy('tanggal_pemasukan') 
            ->get();
        $dates = $income->pluck('tanggal_pemasukan');
        $amounts = $income->pluck('jumlah_pemasukan');

        return compact('dates', 'amounts');
    }

    public function getExpenseChartData()
    {
        $expenses = Pengeluaran::where('users_id', auth()->user()->id)
            ->orderBy('tanggal_pengeluaran') 
            ->get();
    
        $dates = $expenses->pluck('tanggal_pengeluaran');
        $amounts = $expenses->pluck('jumlah_pengeluaran');
    
        return compact('dates', 'amounts');
    }
    
    public function getIncomeChartCategoriesData()
    {
        $income = Pemasukan::where('users_id', auth()->user()->id)
            ->groupBy('kategori') 
            ->selectRaw('sum(jumlah_pemasukan) as total_amount, kategori')
            ->get();

        $categories = $income->pluck('kategori');
        $amounts = $income->pluck('total_amount');

        return compact('categories', 'amounts');
    }

    public function getExpenseChartCategoriesData()
    {
        $expenses = Pengeluaran::where('users_id', auth()->user()->id)
            ->groupBy('kategori') 
            ->selectRaw('sum(jumlah_pengeluaran) as total_amount, kategori')
            ->get();
    
        $categories = $expenses->pluck('kategori');
        $amounts = $expenses->pluck('total_amount');
    
        return compact('categories', 'amounts');
    }

    public function getInsurance()
    {
        $insurances = Asuransi::where('users_id', auth()->user()->id)->get();
    
        return $insurances;
    }

    public function getWishlist()
    {
        $wishlists = Wishlist::where('users_id', auth()->user()->id)->get();
    
        return $wishlists;
    }

    public function getAccount()
    {
        $accounts = AkunKeuangan::where('id', auth()->user()->id)->get();
    
        return $accounts;
    }

    public function getInvestasiChartData()
    {
        $investasis = Investasi::where('user_id', auth()->user()->id)->get();
        $dates = $investasis->pluck('date');
        $nominal_modals = $investasis->pluck('nominal_modal');
        $nominal_investasis = $investasis->pluck('nominal_investasi');
        $statuses = $investasis->pluck('status');
    
        $investasiData = compact('dates', 'nominal_modals', 'nominal_investasis', 'statuses');
    
        return $investasiData;
    }
    
    public function getUpdatedTotals()
    {
        $user = User::find(auth()->user()->id);
    
        $totalPemasukan = Pemasukan::where('users_id', $user->id)->sum('jumlah_pemasukan');
        $totalPengeluaran = Pengeluaran::where('users_id', $user->id)->sum('jumlah_pengeluaran');
        $totalTabungan = Tabungan::where('users_id', $user->id)->sum('nominal');
        $totalHutang = Hutang::where('users_id', $user->id)
            ->where('kategori', 'meminjamkan uang')
            ->sum('nominal_hutang');
        $totalPiutang = Hutang::where('users_id', $user->id)
            ->where('kategori', 'meminjam uang')
            ->sum('nominal_hutang');

        $saldo = $totalPemasukan - $totalPengeluaran;
    
        return response()->json([
            'saldo' => number_format($saldo, 0, ',', '.'),
            'totalPemasukan' => number_format($totalPemasukan, 0, ',', '.'),
            'totalPengeluaran' => number_format($totalPengeluaran, 0, ',', '.'),
            'totalTabungan' => number_format($totalTabungan, 0, ',', '.'), 
            'totalHutang' => number_format($totalHutang, 0, ',', '.'),
            'totalPiutang' => number_format($totalPiutang, 0, ',', '.'),
        ]);
    }
}
