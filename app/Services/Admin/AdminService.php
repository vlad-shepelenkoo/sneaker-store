<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Order;

class AdminService
{
    public function fetchMonthlyReport() : array
    {
        $dashboardData = collect(['ordered', 'delivered', 'canceled'])->mapWithKeys(function(string $status){
            $orders = Order::orders('status', $status);
            $countOrders = $orders->count();
            $sumOrders = $orders->sum('total');
            return [$status => ['count' => $countOrders, 'sum' => $sumOrders]];
        });

        $monthlyDatas = DB::select('Select M.id As MonthNo, M.name As MonthName,
                                           IFNULL(D.TotalAmount, 0) As TotalAmount,
                                           IFNULL(D.TotalOrderedAmount, 0) As TotalOrderedAmount,
                                           IFNULL(D.TotalDeliveredAmount, 0) As TotalDeliveredAmount,
                                           IFNULL(D.TotalCanceledAmount, 0) As TotalCanceledAmount FROM month_names M
                                    LEFT JOIN (Select DATE_FORMAT(created_at, "%b") As MonthName,
                                               MONTH(created_at) As MonthNo,
                                               sum(total) As TotalAmount,
                                               sum(if(status="ordered",total,0)) As TotalOrderedAmount,
                                               sum(if(status="delivered",total,0)) As TotalDeliveredAmount,
                                               sum(if(status="canceled",total,0)) As TotalCanceledAmount
                                    FROM Orders 
                                    WHERE YEAR(created_at)=YEAR(NOW()) 
                                    GROUP BY YEAR(created_at), MONTH(created_at), DATE_FORMAT(created_at, "%b")
                                    ORDER BY MONTH(created_at)) D ON D.MonthNo=M.id');

        $AmountM = implode(',',collect($monthlyDatas)->pluck('TotalAmount')->toArray());
        $OrderedAmountM = implode(',',collect($monthlyDatas)->pluck('TotalOrderedAmount')->toArray());
        $DeliveredAmountM = implode(',',collect($monthlyDatas)->pluck('TotalDeliveredAmount')->toArray());
        $CanceledAmountM = implode(',',collect($monthlyDatas)->pluck('TotalCanceledAmount')->toArray());
                            
        $TotalAmount = collect($monthlyDatas)->sum('TotalAmount');
        $TotalOrderedAmount = collect($monthlyDatas)->sum('TotalOrderedAmount');
        $TotalDeliveredAmount = collect($monthlyDatas)->sum('TotalDeliveredAmount');
        $TotalCanceledAmount = collect($monthlyDatas)->sum('TotalCanceledAmount');

        return [$dashboardData, $AmountM, $OrderedAmountM, $DeliveredAmountM, $CanceledAmountM, $TotalAmount, $TotalOrderedAmount, $TotalDeliveredAmount, $TotalCanceledAmount];
    }
}
