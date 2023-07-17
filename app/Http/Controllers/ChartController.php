<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function showChart(Request $request)
    {
        $month = $request->input('month', null);

        $sold = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereIn('status', ['completed'])
            ->when($month, function ($query, $month) {
                return $query->whereMonth('orders.created_at', $month);
            })
            ->sum('quantity');

        $revenue = DB::table('orders')
            ->where('status', 'completed')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('orders.created_at', $month);
            })
            ->sum('grand_total');

        $orders = DB::table('orders')
            ->whereIn('status', ['pending', 'processing', 'shipping'])
            ->when($month, function ($query, $month) {
                return $query->whereMonth('orders.created_at', $month);
            })
            ->count();

        $temp = DB::table('products')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->select('products.prd_id', 'prd_img.prd_image')
            ->groupBy('products.prd_id');


        $out_of_stocks = DB::table('products')
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->join('prd_img', 'products.prd_id', '=', 'prd_img.prd_id')
            ->select('product_details.prd_amount', 'products.prd_name', 'prd_img.prd_image', 'product_details.prd_size', 'product_details.prd_detail_id')
            ->where('product_details.prd_amount', '<', 3)
            ->groupBy('products.prd_id')
            ->orderBy('prd_amount', 'desc')
            ->get();

        $sells = DB::table('products')
            ->joinSub($temp, 'temp', function (JoinClause $join) {
                $join->on('products.prd_id', '=', 'temp.prd_id');
            })
            ->join('product_details', 'products.prd_id', '=', 'product_details.prd_id')
            ->select('product_details.sold', 'temp.prd_image', 'products.prd_name', DB::raw('SUM(product_details.sold) as t_sold'), 'product_details.prd_detail_id')

            ->where('product_details.sold', '!=', 0)
            ->groupBy('products.prd_id')
            ->orderBy('sold', 'desc')
            ->paginate(5);

        $month = $request->get('month', date('m')); // Lấy tháng từ request hoặc mặc định là tháng hiện tại.

        // Nhận doanh thu dưới dạng Collection của Objects từ DB.
        $revenuesFromDB = Order::select([
            DB::raw('DATE(updated_at) as date'),
            DB::raw('SUM(grand_total) as grand_total'),
        ])
            ->whereYear('updated_at', 2023)
            ->whereMonth('updated_at', $month)
            ->where('status', 'completed')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Chuyển đổi Collection of Objects thành một mảng với keys là ngày và values là grand_total.
        $revenues = $revenuesFromDB->mapWithKeys(function ($item) {
            return [$item['date'] => $item['grand_total']];
        })->toArray();

        $year = date('Y'); // Get current year.

        $revenuesForEachDay = collect(range(1, 31))->mapWithKeys(function ($day) use ($revenues, $month, $year) {
            // Use $year for the calculation.
            $date = Carbon::createFromFormat('Y-m-j', $year . '-' . $month . '-' . $day)->format('Y-m-d');

            // Get revenue for the full date.
            $revenue = $revenues[$date] ?? 0;

            // Format the date to 'm-d' for output.
            $displayDate = Carbon::createFromFormat('Y-m-d', $date)->format('d');

            // Return the result with the updated displayDate as keys.
            return [$displayDate => $revenue];
        })->toArray();



        return view('Admin/modun/dashboard', ['sold' => $sold, 'revenuesForEachDay' => $revenuesForEachDay, 'revenue' => $revenue, 'revenues' => $revenues, 'month' => $month, 'out_of_stocks' => $out_of_stocks, 'orders' => $orders, 'sells' => $sells]);
    }
}
