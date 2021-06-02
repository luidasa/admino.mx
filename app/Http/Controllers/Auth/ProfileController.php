<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function getIndex() {
        return view('auth.profile');
    }

    public function getPagos() {
        return 'Aqui van los pagos';
    }
}
