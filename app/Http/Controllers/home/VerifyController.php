<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;


class VerifyController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $code = mt_rand(100000, 999999);

        $existcode = Code::where('user_id',$user->id)->first();
        if ($existcode) {
            $existcode->delete();
        }
        Code::create([
            'user_id'=>$user->id,
            'code'=>$code,
        ]);
        return view('home.verify.show',compact('code'));
    }

    public function verify(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|min:6,max:6,',
        ]);
        $user = auth()->user();
        $existcode = Code::where('user_id',$user->id)->first();

        if ($request->code == $existcode->code) {
            $user->update([
                'phone_verified_at'=>'2024-02-01 21:55:11'
            ]);
            $existcode->delete();
            if ($user->level == 'agency') {
                alert()->success('شماره شما با موفقیت تایید شد', 'باتشکر');
                return redirect('/agency');
            } else {
                alert()->success('شماره شما با موفقیت تایید شد', 'باتشکر');
                return redirect('/panel');
            }
            
        } else {
            alert()->warning('کد تایید شما صحیح نمیباشد', 'اخطار');
            return redirect()->back();
        }
        
    }
}
