<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function coupons(){
        $coupons = Coupon::sortBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }

    public function coupon_add(){
        return view('admin.coupon-add');
    }

    public function coupon_store(CouponRequest $request){

        $couponValidated = $request->validated();
        Coupon::create($couponValidated);
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been added successfully');
    }

    public function coupon_edit($id){
        $coupon = Coupon::find($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function coupon_update(CouponRequest $request){
        $coupon = Coupon::find($request->id);
        $couponValidated = $request->validated();
        $coupon->update($couponValidated);
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been updated successfully');
    }

    public function coupon_delete($id){
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status', 'Coupon has been deleted successfully');
    }
}