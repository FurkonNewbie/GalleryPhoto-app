<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use RealRashid\SweetAlert\Facades\Alert;

class LogoutAdminController extends Controller
{
    public function __invoke(Request $request)
    {
        //proses logout admin
        Alert::success('success', 'Logout berhasil!');
        Auth::logout();
        return redirect(RouteServiceProvider::HOME);
    }
}
