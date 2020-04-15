<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller\Backend;
use App\Post;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	return view('backend.dashboard.index', 
    		[
    			'users' 	=> User::where('id','!=',1)->count(),
    			'posts' 	=> Post::count()
    		]
    	);
    }
}
