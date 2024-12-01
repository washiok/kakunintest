<?php

namespace App\Http\Controllers;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index()
{
   $admin = Admin::all();

   return view('admin', compact('admin'));
}
     public function store(Request $request)
     {
         $admin = $request->only(['content']);
         return view('admin');
     }
}
