<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\login_pasien;
use Carbon;

class AuthController extends Controller
{
    public function login(Request $req)
    {
        $this->validate($req, [
            'NOPASIEN'=>'min:8|max:8',
            'PASSWD'=>'date_format:dmY',
            'captcha' => 'required|captcha'
        ]);

        $data = login_pasien::where('NOPASIEN', $req->NOPASIEN)
                ->where('PASSWD', $req->PASSWD)
                ->get();
    
        if (count($data) > 0) {
            Auth::guard('pasien')->LoginUsingId($data[0]['NOPASIEN']);
            return redirect()->route('dftr.klinik');
        } else {
            return back()->with('info', 1);
        }
    }

    public function logout()
    {
        if (Auth::guard('pasien')->check()) {
    		Auth::guard('pasien')->logout();
    	}
    	return redirect()->route('login');
    }

    public function autoLogout()
    {
        if (Auth::guard('pasien')->check()) {
    		Auth::guard('pasien')->logout();
    	}
    	return redirect()->route('login')->with('expired', 'Inactivity');
    }

    public function refreshCaptcha()
    {
        return captcha_img('math');
    }
}
