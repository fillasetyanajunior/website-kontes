<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AccountingController extends Controller
{
    private function Project($pilihan)
    {
        if ($pilihan == 1) {
            $periode = 'day';
        } elseif ($pilihan == 2) {
            $periode = 'week';
        } elseif ($pilihan == 3) {
            $periode = 'month';
        } else {
            $periode = 'year';
        }

        $project_options = [
            'chart_title'       => 'Project Running by ' . $periode,
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Project',
            'group_by_field'    => 'created_at',
            'group_by_period'   => $periode,
            'chart_type'        => 'line',
        ];
        return new LaravelChart($project_options);
    }
    private function Income($pilihan)
    {
        if ($pilihan == 1) {
            $periode = 'day';
        } elseif ($pilihan == 2) {
            $periode = 'week';
        } elseif ($pilihan == 3) {
            $periode = 'month';
        } else {
            $periode = 'year';
        }

        $income_options = [
            'chart_title'       => 'Income by ' . $periode,
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Project',
            'group_by_field'    => 'created_at',
            'group_by_period'   => $periode,
            'chart_type'        => 'line',
            'aggregate_function'=> 'sum',
            'aggregate_field'   => 'harga'
        ];
        return new LaravelChart($income_options);
    }
    private function Worker($pilihan)
    {
        if ($pilihan == 1) {
            $periode = 'day';
        } elseif ($pilihan == 2) {
            $periode = 'week';
        } elseif ($pilihan == 3) {
            $periode = 'month';
        } else {
            $periode = 'year';
        }

        $worker_options = [
            'chart_title'       => 'Worker by ' . $periode,
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Worker',
            'group_by_field'    => 'created_at',
            'group_by_period'   => $periode,
            'chart_type'        => 'line',
        ];
        return new LaravelChart($worker_options);
    }
    private function Customer($pilihan)
    {
        if ($pilihan == 1) {
            $periode = 'day';
        } elseif ($pilihan == 2) {
            $periode = 'week';
        } elseif ($pilihan == 3) {
            $periode = 'month';
        } else {
            $periode = 'year';
        }

        $customer_options = [
            'chart_title'       => 'Customer by ' . $periode,
            'report_type'       => 'group_by_date',
            'model'             => 'App\Models\Customer',
            'group_by_field'    => 'created_at',
            'group_by_period'   => $periode,
            'chart_type'        => 'line',
        ];
        return new LaravelChart($customer_options);
    }

    public function GetData(Request $request)
    {
        if ($request != null) {
            $data['project']    = AccountingController::Project($request->pilihanproject);
            $data['worker']     = AccountingController::Worker($request->pilihanworker);
            $data['customer']   = AccountingController::Customer($request->pilihancustomer);
            $data['income']     = AccountingController::Income($request->pilihanincome);
        } else {
            $data['project']    = AccountingController::Project(4);
            $data['worker']     = AccountingController::Worker(4);
            $data['customer']   = AccountingController::Customer(4);
            $data['income']     = AccountingController::Income(4);
        }
        $data['title'] = 'Accounting';

        return view('admin.accounting.accounting', $data);
    }

}
