<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    /**
     * Get the host name of API.
     * 
     * @var String
     */
    private $host;

    public function __construct()
    {
        $this->host = request()->getSchemeAndHttpHost();
    }
    
    /**
     * Uploads an image avatar for User.
     * 
     * @param \Illuminate\Http\Request $request
     * @param Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request, $id)
    {
        $request->validate([
            'img' => 'required|image|max:2048'
        ]);

        $user = User::findOrFail($id);
        
        $img = $request->file('img');
        $storage = Storage::disk('public');
        $fullPath = null;

        if ($img->isValid()) {
            $imgPath = $storage->putFile('avatars', new File($img), 'public');
            $fullPath = $this->host.'/storage/'.$imgPath;
        }
        
        return response()->json($user->fill([
            'avatar' => $fullPath,
        ])->save());
    }

    /**
     * Remove user avatar.
     * 
     * @param Integer $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function remove($id)
    {
        $user = User::findOrFail($id);
        
        return response()->json($user->fill([
            'avatar' => $this->host."/default/avatar.jpg"
        ])->save());
    }
}
