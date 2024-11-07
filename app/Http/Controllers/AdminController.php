<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AdminController extends Controller
{
    public function index(): View
    {
        return view('/admin/dashboard');
    }

    public function viewUsers()
    {
        $users = User::all(); // Retrieve all records from the users table
        return view('admin.users', compact('users')); // Pass data to the view
    }

    public function viewSelectedUser(Request $request)
    {
        return view('admin.selecteduser', [
            'user' => $request->user(),
        ]);
    }
    public function addUser(Request $request)
    {
        return view('admin.adduser', [
            'user' => $request->user(),
        ]);
    }
}
