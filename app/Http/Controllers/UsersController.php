<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use Storage;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::find($id);

        return view('users.show', [
            'user' => $user,
        ]);
    }
    
    
    // ファイルアップロード処理
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
                // 最小縦横120px 最大縦横400px
                'dimensions:min_width=120,min_height=120,max_width=400,max_height=400',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            
            // S3にアップロード
            $path = Storage::disk('s3')->put('profiles', $request->file, 'public');
            // S3アップロード後のURL取得
            $url = Storage::disk('s3')->url($path);
            
            //ユーザ情報の更新
            $user = User::find(auth()->id());
            $user->image_path = $url;
            $user->save();
            
            return view('users.show', [
                'user' => $user,
            ]);
        } else {
            return view('users.show', [
                'user' => $user,
            ]);
        }
    }
}
