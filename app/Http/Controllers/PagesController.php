<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller {

    public function welcome() {
        
        if(Auth::user()) {
            $user = Auth::user();
        } else {
            $user['name'] = "Guest";
        }
        return view('welcome', compact('user'));
    }

}
