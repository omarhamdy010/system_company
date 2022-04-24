<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
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
            'password' => Hash::make($request->password)
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

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->image != 'default.png') {
            Storage::disk('public_uploads')->delete('/user/' . $user->image);
        }
        $user->update([
            'image' => 'default.png'
        ]);
        return redirect()->back();
    }
}
