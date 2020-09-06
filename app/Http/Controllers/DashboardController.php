<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $sql = "SELECT MONTHNAME(trx_date) month, count(*) total FROM transactions ".
        "GROUP BY MONTHNAME(trx_date) ".
        "ORDER BY MONTH(trx_date)";

        $transactions = \DB::select($sql);



        $months = [];
        $totals = [];

        foreach ($transactions as $key => $value) {
            $months[] = $value->month;
            $totals[] = $value->total;
        }

        $chart = [
            'months' => $months,
            'totals' => $totals,
        ];

        $trx_all = \App\Transaction::orderBy('updated_at', 'DESC')->limit(10)->get();


        return view('admin.dashboard', compact('chart', 'trx_all'));
    }
}
