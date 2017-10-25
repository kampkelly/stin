<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Startup;
use App\Category;
use App\StartupsPhoto;

class StartupsPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
       # $this->middleware('guest', ['except' => ['index']]);
    }

    public function destroy(Request $request, $id)
    {
        $id = request('photo_id');
        $deleted = StartupsPhoto::find($id);
        $deleted->delete();
        return redirect()->back()->with('message', 'Image deleted!');
    }
}
