<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Startup;
use Image;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
    }
   
    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
           'name' => 'required'
        ]); 
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $dd = $file->getClientOriginalName();
            $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
            $file_ext = substr($dd, strripos($dd, '.')); // get file extension
            $t = date("i-s");
            $newfilename = md5($file_basename) . $t . $file_ext;
            Image::make($file)->resize(780, 350)->save(public_path('/static-pics/categories/'. $newfilename));
        }

         Category::create([
            'name' => request('name'),
            'description' => request('description'),
            'image' => $newfilename
        ]);
        return redirect('/');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
       return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if(Input::hasFile('image')){
            $file=Input::file('image');
            $dd = $file->getClientOriginalName();
            $file_basename = substr($dd, 0, strripos($dd, '.')); // get file name
            $file_ext = substr($dd, strripos($dd, '.')); // get file extension
            $t = date("i-s");
            $newfilename = md5($file_basename) . $t . $file_ext;
          //  Image::make($file)->resize(900, 600)->save(public_path('/static-pics/categories/'. $newfilename));
            Image::make($file)->resize(1500, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('/static-pics/categories/'. $newfilename));
           // $file->move('static-pics/categories', $newfilename);
        }

         $category = Category::find($id);

            if (Input::has('name')) $category->name = Input::get('name');
            if (Input::hasFile('image')) $category->image = $newfilename;
            if (Input::has('description')) $category->description = Input::get('description');
            
            $category->save();

            session()->flash('message', 'Category Updated'); //THEN INCLUDE IN THE REDIRECTED FUNCTION, HERE ITS "SHOW"
            return redirect()->back();
    }

    
    public function destroy(Request $request, $id)
    {
         if(checkPermission(['superadmin'])) {
            $deleted = Category::find($id);
            $deleted->delete();
            return redirect()->back()->with('message', 'Category deleted!');
            }else{
                return redirect()->back()->with('message', 'Unauthorized operation!');
            }
    }
}
