<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontController extends Controller
{
    public function storeNewsletter(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:newsletters|max:55'
        ]);

        $data = array();
        $data['email'] = $request->email;
        DB::table('newsletters')->insert($data);
        $notification = array([
            'messege' => 'Thanks for subscribing',
            'alert-type' => 'success',
        ]);
        return Redirect()->back()->with($notification);
    }
}
