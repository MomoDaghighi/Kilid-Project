<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit(Type $var = null)
    {
        $user = auth()->user();
        return view('panel.user.edit',compact('user'));
    }

    public function update(Request $request,User $user)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required|min:11,max:11,',
            'email' => 'required|min:11,max:11,',
        ]);
        $user->update([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'phone'=>$request->phone,
            'email'=>$request->email,
        ]);

        alert()->success('اطلاعات شما با موفقیت ویرایش شد', 'با تشکر');
        return redirect()->back();
    }
}
