<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');
        $totalProducts = Order::count();
        $totalCustomers = User::where('role', 1)->count();

        // This month revenue
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');

        $revenueThisMonth = Order::where('status', '!=', 'cancelled')
                                ->whereDate('created_at', '>=', $startOfMonth)
                                ->whereDate('created_at', '<=', $currentDate)
                                ->sum('grand_total');

        // Last month revenue
        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $lastMonthName = Carbon::now()->subMonth()->endOfMonth()->format('M');

        $revenueLastMonth = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $lastMonthStartDate)
            ->whereDate('created_at', '<=', $lastMonthEndDate)
            ->sum('grand_total');


        // Last 30 Days revenue
        $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');

        $revenueLastThirtyDays = Order::where('status', '!=', 'cancelled')
            ->whereDate('created_at', '>=', $lastThirtyDayStartDate)
            ->whereDate('created_at', '<=', $currentDate)
            ->sum('grand_total');


        return view('admin.dashboard',[
           'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalCustomers' => $totalCustomers,
            'totalRevenue' => $totalRevenue,
            'revenueThisMonth' => $revenueThisMonth,
            'revenueLastMonth' => $revenueLastMonth,
            'lastThirtyDayStartDate' => $lastThirtyDayStartDate,
            'lastMonthName' => $lastMonthName
        ]);
    }
    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect()->route('admin.login');
    }
}
