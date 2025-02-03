<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class ProductMainController extends Controller
{
    public function getOrderDetails(Request $request)
    {
        $filter = $request->input('filter', 'today'); // Default filter is 'today'

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        switch ($filter) {
            case 'today':
                $currentPeriodOrders = Order::whereDate('created_at', $today)->count();
                $previousPeriodOrders = Order::whereDate('created_at', $yesterday)->count();
                break;

            case 'this month':
                $currentPeriodOrders = Order::where('created_at', '>=', $startOfMonth)->count();
                $previousPeriodOrders = Order::whereBetween('created_at', [$startOfMonth->copy()->subMonth(), $startOfMonth])->count();
                break;

            case 'this year':
                $currentPeriodOrders = Order::where('created_at', '>=', $startOfYear)->count();
                $previousPeriodOrders = Order::whereBetween('created_at', [$startOfYear->copy()->subYear(), $startOfYear])->count();
                break;

            default:
                $currentPeriodOrders = 0;
                $previousPeriodOrders = 0;
                break;
        }

        // Calculate percentage increase
        $percentageIncrease = 0;
        if ($previousPeriodOrders > 0) {
            $percentageIncrease = (($currentPeriodOrders - $previousPeriodOrders) / $previousPeriodOrders) * 100;
        }

        return response()->json([
            'success' => true,
            'orders' => $currentPeriodOrders, // Renamed from 'todayorders' to 'orders'
            'percentage_increase' => round($percentageIncrease, 2)
        ]);
    }

    public function getRevenueDetails(Request $request)
    {
        $filter = $request->input('filter', 'today'); // Default filter is 'today'

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        switch ($filter) {
            case 'today':
                $currentPeriodRevenue = Order::whereDate('created_at', $today)->sum('grand_total');
                $previousPeriodRevenue = Order::whereDate('created_at', $yesterday)->sum('grand_total');
                break;

            case 'this month':
                $currentPeriodRevenue = Order::where('created_at', '>=', $startOfMonth)->sum('grand_total');
                $previousPeriodRevenue = Order::whereBetween('created_at', [$startOfMonth->copy()->subMonth(), $startOfMonth])->sum('grand_total');
                break;

            case 'this year':
                $currentPeriodRevenue = Order::where('created_at', '>=', $startOfYear)->sum('grand_total');
                $previousPeriodRevenue = Order::whereBetween('created_at', [$startOfYear->copy()->subYear(), $startOfYear])->sum('grand_total');
                break;

            default:
                $currentPeriodRevenue = 0;
                $previousPeriodRevenue = 0;
                break;
        }

        // Calculate percentage increase or decrease
        $percentageChange = 0;
        if ($previousPeriodRevenue > 0) {
            $percentageChange = (($currentPeriodRevenue - $previousPeriodRevenue) / $previousPeriodRevenue) * 100;
        }

        return response()->json([
            'success' => true,
            'revenue' => $currentPeriodRevenue,
            'percentage_change' => round($percentageChange, 2)
        ]);
    }
    public function getCustomerDetails(Request $request)
    {
        $filter = $request->input('filter', 'today'); // Default filter is 'today'

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        switch ($filter) {
            case 'today':
                $currentPeriodCustomers = Order::whereDate('created_at', $today)
                    ->select('email')
                    ->distinct()
                    ->count();
                $previousPeriodCustomers = Order::whereDate('created_at', $yesterday)
                    ->select('email')
                    ->distinct()
                    ->count();
                break;

            case 'this month':
                $currentPeriodCustomers = Order::where('created_at', '>=', $startOfMonth)
                    ->select('email')
                    ->distinct()
                    ->count();
                $previousPeriodCustomers = Order::whereBetween('created_at', [$startOfMonth->copy()->subMonth(), $startOfMonth])
                    ->select('email')
                    ->distinct()
                    ->count();
                break;

            case 'this year':
                $currentPeriodCustomers = Order::where('created_at', '>=', $startOfYear)
                    ->select('email')
                    ->distinct()
                    ->count();
                $previousPeriodCustomers = Order::whereBetween('created_at', [$startOfYear->copy()->subYear(), $startOfYear])
                    ->select('email')
                    ->distinct()
                    ->count();
                break;

            default:
                $currentPeriodCustomers = 0;
                $previousPeriodCustomers = 0;
                break;
        }

        // Calculate percentage increase or decrease
        $percentageChange = 0;
        if ($previousPeriodCustomers > 0) {
            $percentageChange = (($currentPeriodCustomers - $previousPeriodCustomers) / $previousPeriodCustomers) * 100;
        }

        return response()->json([
            'success' => true,
            'customers' => $currentPeriodCustomers,
            'percentage_change' => round($percentageChange, 2)
        ]);
    }

    public function getGraphData(Request $request)
    {
        $filter = $request->input('filter', 'today'); // Default filter is 'today'

        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();
        $startOfYear = Carbon::now()->startOfYear();

        switch ($filter) {
            case 'today':
                $salesData = Order::whereDate('created_at', $today)
                    ->selectRaw('HOUR(created_at) as hour, COUNT(*) as count')
                    ->groupBy('hour')
                    ->pluck('count', 'hour')
                    ->toArray();

                $revenueData = Order::whereDate('created_at', $today)
                    ->selectRaw('HOUR(created_at) as hour, SUM(grand_total) as total')
                    ->groupBy('hour')
                    ->pluck('total', 'hour')
                    ->toArray();

                $customersData = Order::whereDate('created_at', $today)
                    ->selectRaw('HOUR(created_at) as hour, COUNT(DISTINCT email) as count')
                    ->groupBy('hour')
                    ->pluck('count', 'hour')
                    ->toArray();

                $categories = array_map(function ($hour) {
                    return Carbon::today()->setHour($hour)->toDateTimeString();
                }, range(0, 23)); // Ensure all hours are included
                break;

            case 'this month':
                $salesData = Order::where('created_at', '>=', $startOfMonth)
                    ->selectRaw('DAY(created_at) as day, COUNT(*) as count')
                    ->groupBy('day')
                    ->pluck('count', 'day')
                    ->toArray();

                $revenueData = Order::where('created_at', '>=', $startOfMonth)
                    ->selectRaw('DAY(created_at) as day, SUM(grand_total) as total')
                    ->groupBy('day')
                    ->pluck('total', 'day')
                    ->toArray();

                $customersData = Order::where('created_at', '>=', $startOfMonth)
                    ->selectRaw('DAY(created_at) as day, COUNT(DISTINCT email) as count')
                    ->groupBy('day')
                    ->pluck('count', 'day')
                    ->toArray();

                $categories = array_map(function ($day) {
                    return Carbon::now()->startOfMonth()->addDays($day - 1)->toDateTimeString();
                }, range(1, 31)); // Ensure all days are included
                break;

            case 'this year':
                $salesData = Order::where('created_at', '>=', $startOfYear)
                    ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray();

                $revenueData = Order::where('created_at', '>=', $startOfYear)
                    ->selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
                    ->groupBy('month')
                    ->pluck('total', 'month')
                    ->toArray();

                $customersData = Order::where('created_at', '>=', $startOfYear)
                    ->selectRaw('MONTH(created_at) as month, COUNT(DISTINCT email) as count')
                    ->groupBy('month')
                    ->pluck('count', 'month')
                    ->toArray();

                $categories = array_map(function ($month) {
                    return Carbon::now()->startOfYear()->addMonths($month - 1)->toDateTimeString();
                }, range(1, 12)); // Ensure all months are included
                break;

            default:
                $salesData = [];
                $revenueData = [];
                $customersData = [];
                $categories = [];
                break;
        }

        // Fill missing data points with 0
        $salesData = array_replace(array_fill_keys(array_keys($categories), 0), $salesData);
        $revenueData = array_replace(array_fill_keys(array_keys($categories), 0), $revenueData);
        $customersData = array_replace(array_fill_keys(array_keys($categories), 0), $customersData);

        return response()->json([
            'success' => true,
            'series' => [
                ['name' => 'Sales', 'data' => array_values($salesData)],
                ['name' => 'Revenue', 'data' => array_values($revenueData)],
                ['name' => 'Customers', 'data' => array_values($customersData)]
            ],
            'categories' => $categories
        ]);
    }
    public function getProduct(){
        $products = Product::all();
        return response()->json([
            'success' => true,
            'products'=>$products,
        ]);
    }

}
