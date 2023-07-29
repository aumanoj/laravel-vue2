<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{

    use VerifiesEmails;
    
    public function __construct()
    {
        //$this->middleware('auth:api',['verified'])->only('resend');
        $this->middleware('auth')->except(['verify','resend']);
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:12,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        if ($request->route('id') != $request->user()->getKey()) {
            throw new AuthorizationException;
        }

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified',
            ],422);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        // return response()->json([
        //     'verified' => true,
        // ]);
        return redirect()->to('http://manoj.aphroecs.com/admin/dashboard');
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email already verified',
            ],422);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification email resent',
        ]);
    }
}
