<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function createAdmin()
    {
        // Hanya untuk development, sebaiknya dibuat seeder
        $admin = Admin::create([
            'nama' => 'Admin',
            'email' => 'admin@example.com',
            'whatsapp' => '6281234567890',
            'password' => Hash::make('password123'),
        ]);

        return response()->json(['message' => 'Admin created', 'admin' => $admin]);
    }
}
