<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Services\Admin\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(private AdminService $adminService){}

    public function index(Request $request){
        $contacts = Contact::where('read', Constants::UNREAD_MESSAGE)->count();
        $user = $request->user();
        $request->session()->put('user', $user);
        $orders = Order::orderBy('created_at', 'DESC')->get()->take(10);

        $totalCount = Order::count();
        $totalSum = Order::sum('total');

        [$dashboardData, $AmountM, $OrderedAmountM, 
         $DeliveredAmountM, $CanceledAmountM, $TotalAmount, 
         $TotalOrderedAmount, $TotalDeliveredAmount, $TotalCanceledAmount] = $this->adminService->fetchMonthlyReport();

        return view('admin.index', compact('orders', 'totalCount', 'totalSum', 'dashboardData', 'AmountM', 'OrderedAmountM', 'DeliveredAmountM', 'CanceledAmountM', 'TotalAmount', 'TotalOrderedAmount', 'TotalDeliveredAmount', 'TotalCanceledAmount'));
    }

    public function search(Request $request){
        $query = $request->input('query');
        $results = Product::where('name', 'LIKE', "%{$query}%")->get()->take(8);
        return response()->json($results);
    }
}
