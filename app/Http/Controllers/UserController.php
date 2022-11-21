<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
  
use App\Models\User;
use App\Models\Voucher;
use Validator;
use Artisan;
class UserController extends Controller
{
    public function index()
    {

        return view('pages.users.index');
        
    }
}
