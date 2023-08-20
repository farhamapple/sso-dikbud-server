<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthOtpController extends Controller
{
    static function generateOtp($user)
    {
        # User Does not Have Any Existing OTP
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();
        $now = Carbon::now();
        if($verificationCode && $now->isBefore($verificationCode->expire_at)){
            return $verificationCode;
        }
        // Create a New OTP
        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }
    public function verification($ref_user)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('auth.otp-verification')->with([
            'pageConfigs' => $pageConfigs,
            'ref_user' => $ref_user
        ]);
    }

    public function loginWithOtp($ref_user,Request $request)
    {
        #Validation
        $request->validate([
            'otp' => 'required'
        ]);
        // user 
        $dataUser = User::where("ref",$ref_user)->first();
        #Validation Logic
        $verificationCode   = VerificationCode::where('user_id', $dataUser->id)->where('otp', $request->otp)->first();

        $now = Carbon::now();
        if (!$verificationCode) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        }elseif($verificationCode && $now->isAfter($verificationCode->expire_at)){
            return redirect()->route('otp.verification',$ref_user)->with('error', 'Your OTP has been expired');
        }
        if($dataUser){
            // Expire The OTP
            $verificationCode->update([
                'expire_at' => Carbon::now()
            ]);
            // Auth::login($dataUser);
            
            return redirect(route('auth-forgot-password-form', $dataUser->activation_code));
        }
        $pageConfigs = ['myLayout' => 'blank'];
        return view('content.authentications.auth-login-basic', [
          'pageConfigs' => $pageConfigs,
          'from' => session('link'),
        ])->with('error', 'Your Otp is not correct');
    }
}
