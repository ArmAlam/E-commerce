<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon()
    {
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon', compact('coupon'));
    }

    public function storeCoupon(Request $request)
    {
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;

        DB::table('coupons')->insert($data);
        $notification = array(
            'messege' => 'Coupon Inserted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function editCoupon($id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.coupon.edit_coupon', compact('coupon'));
    }

    public function updateCoupon(Request $request, $id)
    {
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;

        DB::table('coupons')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'Coupon Updated',
            'alert-type' => 'success'
        );
        return Redirect()->route('admin.coupon')->with($notification);
    }


    public function deleteCoupon($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Coupon Deleted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }


    public function newsletter()
    {
        $sub = DB::table('newsletters')->get();
        return view('admin.coupon.newsletter', compact('sub'));
    }

    public function deleteSub($id)
    {
        DB::table('newsletters')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Subscriber Deleted',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function Seo()
    {
        $seo = DB::table('seo')->first();
        return view('admin.coupon.seo', compact('seo'));
    }

    public function UpdateSeo(Request $request)
    {
        $id = $request->id;
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['google_analytics'] = $request->google_analytics;
        $data['bing_analytics'] = $request->bing_analytics;
        DB::table('seo')->where('id', $id)->update($data);
        $notification = array(
            'messege' => 'SEO Updated',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
