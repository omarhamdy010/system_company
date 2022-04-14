<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\PageUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PageUserController extends Controller
{
    public function index()
    {
        $presence_users = PageUser::all();
        return view('/dashboard.user_page.index', compact('presence_users'));
    }

    public function store(User $user, Request $request)
    {
        $pageuser = [
            'username' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'presence_time' => '-',
            'absence_time' => '-',
        ];

        $pag = PageUser::create($pageuser);
        $pageuser = [
            'presence_time' => $pag->created_at,
        ];

        $pag->update($pageuser);

        return redirect()->back();
    }


    public function save(User $user, Request $request)
    {
        $pageuser = [
            'username' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'presence_time' => '-',
            'absence_time' => '-',
        ];

        $pag = PageUser::create($pageuser);
        $pageuser = [
            'absence_time' => $pag->created_at,
        ];

        $pag->update($pageuser);

        return redirect()->back();
    }

    public function profile()
    {
        return view('dashboard.user_page.page');
    }

    public function updateprofile(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'email',
            'phone' => 'max:13',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password'=>$request->password
        ]);

        return redirect()->back();
    }

    public function updateimage(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->except(['image']);

        if ($request->image) {
            if ($user->image != 'default.png') {
                Storage::disk('public_uploads')->delete('/user/' . $user->image);
            }
            $img = Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/user/' . $request->image->hashName()));

            $data['image'] = $request->image->hashName();
            $user->update($data);
        } else {
            Auth()->user()->image_path;
        }
        return redirect()->back();
    }

    public function destroy($id){
        $user =User::find($id);
        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/user/' . $user->image);
        }
        $user->update([
            'image'=>'default.png'
        ]);
        return redirect()->back();
    }

}
