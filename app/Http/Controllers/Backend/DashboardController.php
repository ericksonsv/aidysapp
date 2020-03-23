<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller\Backend;
use Illuminate\Http\Request;
use App\User;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('backend.dashboard.index', 
    		[
    			'users' => User::where('id','!=',1)->count()
    		]
    	);
    }
}
