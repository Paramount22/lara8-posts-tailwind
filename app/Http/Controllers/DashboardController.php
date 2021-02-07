<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('dashboard');
    }
}
