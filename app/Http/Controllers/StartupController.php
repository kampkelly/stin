<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Startup;
use App\Category;
use App\StartupsPhoto;
use App\YoutubeVideo;
use App\Thread;
use App\Message;
use App\Mail\Welcome;
use Dawson\Youtube\Facades\Youtube;
use Illuminate\Support\Facades\DB;
use Image;
use App\Http\Controllers\Mail\Mailer;
//use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendVerificationEmail;
//use LRedis;
use App\Events\InnovationCreated;

class StartupController extends Controller
{
    public function __construct()
    {
     //   $this->middleware('auth', ['except' => ['briefing']]);
        $this->middleware('guest')->only('briefing');
    }

    public function briefing() {
        $innovations = Startup::where('status', 'pending')->orWhere('status', 'approved')->with('user')->orderBy('id', 'desc')->get();
        return view('briefing', compact('innovations'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
           'startup_title' => 'required|min:8',
        //    'startup_image'       => 'required|mimes:png,jpg,jpeg'
        ]); 
        $newfilename = '';
        if(Input::hasFile('startup_image')){
            $file=Input::file('startup_image');
            $dd = $file->getClientOriginalName();
            $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
            $file_ext = substr($dd, strripos($dd, '.')); // get file extension
            $t = date("i-s");
            $newfilename = md5($file_basename) . $t . $file_ext;
            Image::make($file)->resize(300, 300)->save(public_path('/uploads/startup_photos/'. $newfilename));
           // $file->move('uploads', $newfilename);
        }
        $slug_title = request('startup_title');
        $slug_username = Auth::user()->username;
        $slug_date = date("Y-m-d-i-s-a");
        $slug_combine = $slug_title.' '.$slug_username.' '.$slug_date;
        $slug_format = strtr($slug_combine, ' ', '-');
        $slug = $slug_format;
        //
       $startup = Startup::create([
            'title' => request('startup_title'),
            'group_name' => request('startup_company'),
            'short_desc' => request('short_desc'),
            'full_desc' => request('short_desc'),
            'image' => $newfilename,
            'aim' => request('startup_aim'),
            'importance' => request('startup_imp'),
            'achievements' => request('startup_achievements'),
            'features' => request('startup_features'),
            'category_id' => request('startup_category'),
            'user_id' => Auth::user()->id,
            'contacts' => request('startup_contacts'),
            'status' => 'pending',
            'slug' => $slug
        ]); 

       if(checkPermission(['admin', 'superadmin'])) {
           $startup->featured = 'yes';
           $startup->save();
       }

       if(Input::hasFile('photos')){
             foreach (request('photos') as $photo) {
                //uploading photo starts
                $file= $photo;
                $dd = $file->getClientOriginalName();
                $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
                $file_ext = substr($dd, strripos($dd, '.')); // get file extension
                $t = date("i-s");
                $filename = md5($file_basename) . $t . $file_ext;
                $file->move('uploads/startup_photos', $filename);
                //uploading photo ends
                StartupsPhoto::create([
                    'startup_id' => $startup->id,
                    'filename' => $filename
                ]);
            }
        }
        $user = Auth::user();
        event(new InnovationCreated($user, $startup));
        session()->flash('message', 'Innovation Added Successfully');
        return redirect('/dashboard#/innovations');
    }

    public function edit($slug)
    {
        $startup = Startup::where('slug', $slug)->first();
        if(Auth::user()->id == $startup->user_id){
          $categories = Category::all();
          $startups = Startup::where('status', 'pending')->orderBy('id', 'desc')->simplePaginate(1); 
         $thedata = [$categories, $startup];
            return $thedata;
       }else{
            $thedata = [];
            return $thedata;
       }
    }

    public function update(Request $request, $slug)
    {
        $this->validate(request(), [
           'startup_title' => 'required|min:8'
           # 'startup_image'       => 'required|mimes:png,jpg,jpeg'
        ]); 
        $startup = Startup::where('slug', $slug)->first();
        if(Input::hasFile('startup_image')){
            $file=Input::file('startup_image');
            $dd = $file->getClientOriginalName();
            $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
            $file_ext = substr($dd, strripos($dd, '.')); // get file extension
            $t = date("i-s");
            $newfilename = md5($file_basename) . $t . $file_ext;
           // Image::make($file)->resize(780, 350)->save(public_path('/uploads/'. $newfilename));
            Image::make($file)->resize(1500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('/uploads/startup_photos/'. $newfilename));
           // $file->move('uploads', $newfilename);
            if(file_exists( public_path('uploads/startup_photos/'. $startup->image) )) {
                unlink(public_path('uploads/startup_photos/'. $startup->image));
            }
          //  File::delete();
        }
        
         
         //slug
          $slug_title = request('startup_title');
          $slug_username = Auth::user()->username;
          $slug_date = $startup->created_at;
          $slug_date = date_format($slug_date,"Y-m-d-i-s-a");
          $slug_combine = $slug_title.' '.$slug_username.' '.$slug_date;
          $slug_format = strtr($slug_combine, ' ', '-');
          $slug = $slug_format;
          //slug
            if (Input::has('startup_title')) $startup->title = Input::get('startup_title');
            if (Input::has('startup_title')) $startup->slug = $slug;
            if (Input::hasFile('startup_image')) $startup->image = $newfilename;
            if (Input::has('startup_company')) $startup->group_name = Input::get('startup_company');
            if (Input::has('short_desc')) $startup->short_desc = Input::get('short_desc');
            if (Input::has('full_desc')) $startup->full_desc = Input::get('full_desc');
            if (Input::has('startup_aim')) $startup->aim = Input::get('startup_aim');
            if (Input::has('startup_imp')) $startup->importance = Input::get('startup_imp');
            if (Input::has('startup_achievements')) $startup->achievements = Input::get('startup_achievements');
            if (Input::has('startup_features')) $startup->features = Input::get('startup_features');
            if (Input::has('startup_category')) $startup->category_id = Input::get('startup_category');
            if (Input::has('startup_contacts')) $startup->contacts = Input::get('startup_contacts'); 
            $startup->save();

            if(Input::hasFile('photos')){
             foreach (request('photos') as $photo) {
                //uploading photo starts
                $file= $photo;
                $dd = $file->getClientOriginalName();
                $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
                $file_ext = substr($dd, strripos($dd, '.')); // get file extension
                $t = date("i-s");
                $filename = md5($file_basename) . $t . $file_ext;
                Image::make($file)->resize(1500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('/uploads/startup_photos/'. $filename));
                //uploading photo ends
                StartupsPhoto::create([
                    'startup_id' => $startup->id,
                    'filename' => $filename
                ]);
            }
        }
        $user = Auth::user();
        session()->flash('message', 'Innovation Updated');
        return redirect('/dashboard#/'.Auth::user()->username.'/innovations');
    }  

    public function startupsphotoupdate(Request $request, $slug)
    {   
        
            if(Input::hasFile('photos')){
             foreach (request('photos') as $photo) {
                if(filesize($photo) > 1000000){
                    session()->flash('message', 'Image too big');
                    return redirect('/fileuploaderror');
                }else{
                    //uploading photo starts
                    $file= $photo;
                    $dd = $file->getClientOriginalName();
                    $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
                    $file_ext = substr($dd, strripos($dd, '.')); // get file extension
                    $t = date("i-s");
                    $filename = md5($file_basename) . $t . $file_ext;
                    //Image::make($file)->resize(300, 300)->save(public_path('/uploads/'. $filename));
                    Image::make($file)->resize(1500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(public_path('/uploads/startup_photos/'. $filename));
                    //uploading photo ends
                    $startup = Startup::where('slug', $slug)->first();
                    $slug = $startup->slug;
                    StartupsPhoto::create([
                        'startup_id' => $startup->id,
                        'filename' => $filename
                    ]);
                }
            }
        }
            session()->flash('message', 'Image added'); 
            return redirect()->back();
    }


//SEARCH BEGINS

    public function newsearch(Request $request, $query)
    {
        $error = ['error' => 'No results found, please try with different keywords.'];
         if($request->qu) {
        //    $startups = Startup::search($request->qu)->where('status', 'approved')->with('user')->get();
            $startups = Startup::search($request->qu)->get();
            return $startups;
            if(count($startups >= 1)) {
                return $startups;
            }else {
                return $error;
            }
           // return $startups->count() ? $posts : $error;
        } 
        return $error;
    }

//SEARCH ENDS

    public function postinnovator_update(Request $request, $id){
            $user = User::find($id);
            if ($request->address) $user->address = $request->address;
            if ($request->state) $user->state = $request->state;
            if ($request->country) $user->country = $request->country;
            if ($request->age) $user->age = $request->age;
            if ($request->contacts) $user->contacts = $request->contacts;
            if ($request->website) $user->website = $request->website;
            if ($request->facebook) $user->facebook = $request->facebook;
            if ($request->linkedin) $user->linkedin = $request->linkedin;
            if ($request->twitter) $user->twitter = $request->twitter;
            if ($request->bio) $user->bio = $request->bio;
            if ($request->education) $user->education = $request->education;
            if ($request->profession) $user->profession = $request->profession;
            if ($request->interests) $user->interests = $request->interests;
            $user->save();
            $data = 'gameboy';
            return 'Profile Updated!';
    }

     public function upload_profile_pic(Request $request){
        if(Input::hasFile('my_file')){
            $file=Input::file('my_file');
            $dd = $file->getClientOriginalName();
            $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
            $file_ext = substr($dd, strripos($dd, '.')); // get file extension
            $t = date("i-s");
            $newfilename = md5($file_basename) . $t . $file_ext;
            Image::make($file)->resize(1500, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save(public_path('/uploads/profile-pic/'. $newfilename));
        }
        $user = Auth::user();
        if (Input::hasFile('my_file')) $user->image = $newfilename;
        $user->save();
        session()->flash('message', 'Profile picture saved!'); 
         return redirect()->back();
    }

}
