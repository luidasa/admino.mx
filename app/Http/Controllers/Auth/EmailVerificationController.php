<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function verifyEmail() {
        return view('auth.verify');
    }

    public function verificationHandler(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/login');
    }

    public function resendEmailVerification (Request $request) {

        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }
}
