<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class WishlistController extends Controller
{
    public function addWishlist($id)
    {

        $userid = Auth::id();
        $check = DB::table('wishlists')
            ->where('user_id', $userid)
            ->where('product_id', $id)
            ->first();
        $data = array(
            'user_id' => $userid,
            'product_id' => $id
        );


        if (Auth::check()) {
            if ($check) {
                return \Response::json(['error' => 'Already in wishlist']);
            } else {
                DB::table('wishlists')->insert($data);
                return \Response::json(['success' => 'Added to wishlist']);
            }
        } else {
            return \Response::json(['error' => 'Please login first.']);
        }
    }
}
