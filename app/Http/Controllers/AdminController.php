<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * View admin dashbaord.
     */
    public function index(): View
    {
        return view('/admin/dashboard');
    }

    /**
     * Retrieve all records from the users table.
     */
    public function viewUsers()
    {
        $users = User::all();
        return view('admin.users.users', compact('users')); // Pass data to the view
    }

    /**
     * View the selected user.
     */
    public function viewSelectedUser(Request $request)
    {
        return view('admin.users.selecteduser', [
            'user' => $request->user(),
        ]);
    }

    /**
     *  Create a new user.
     */
    public function addUser(Request $request)
    {
        return view('admin.users.adduser', [
            'user' => $request->user(),
        ]);
    }
}
