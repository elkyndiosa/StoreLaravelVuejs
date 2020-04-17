<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

//
class CategoryController extends Controller {

    public function index() {
        $category = Category::orderBy('id', 'DESC')->get();
        $notification = ProductController::countProdS();
        return view('adminCategories', [
            'category' => $category,
            'notification' => $notification
        ]);
    }

    public function create(Request $request) {
        $validate = $this->validate($request, [
            'name' => ['required']
        ]);
       
        $name = ucfirst($request->name);
        $category = new Category();
        if (isset($request->image)) {
            $image = $request->image;
            $image_path = time() . $image->getClientOriginalName();
            $imagejpg = File::get($image);
            Storage::put($image_path, $imagejpg);
            $category->image_path = $image_path;
        }
        $category->name = $name;
        
        $category->save();
    }

    public function update(Request $request) {
        $validate = $this->validate($request, [
            'id' => ['required'],
            'name' => ['required', 'max:100'],
        ]);
        $id = $request->id;
        $name = ucfirst($request->name);
        
        $category = Category::findOrFail($id);
        
        if (isset($request->image)) {
            
            Storage::delete($category->image_path);
            $image = $request->image;
            $image_path = time() . $image->getClientOriginalName();
            
            $category->image_path = $image_path;
            $imagejpg = File::get($image);


            Storage::put($image_path, $imagejpg);
        }
        $category->name = $name;
        
        $category->update();
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public function get() {
        $Category = Category::orderBy('id', 'DESC')->get();
        return $Category;
    }
}
