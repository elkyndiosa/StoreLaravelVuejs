<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Category;

class SliderController extends Controller {

    public function index() {
        $sliders = slider::orderBy('id', 'DESC')->get();
        return $sliders;
    }

    public function create(Request $request) {
        $validate = $this->validate($request, [
            'image' => ['required']
        ]);
        $title = $request->title;
        
        $text = $request->text;
        if($request->color){
            $color = $request->color;
        }else{
            $color = 'text-dark';
        }
        
        $image = $request->image;

        $image_path = time() . $image->getClientOriginalName();
        $imagejpg = File::get($image);
        Storage::put($image_path, $imagejpg);
        $slider = new slider();
        $slider->title = $title;
        $slider->text = $text;
        $slider->color = $color;
        $slider->image_path = $image_path;
        $slider->save();
        return 'exito';
    }

    public function admin() {
        $category = Category::orderBy('id', 'DESC')->get();
        $notification = ProductController::countProdS();
        return view('adminSliders', [
            'category' => $category,
            'notification' => $notification
        ]);
    }
    public function update(Request $request) {
        $validate = $this->validate($request, [
            'id' => ['required'],
            'title' => ['required'],
            'text' => ['required'],
            'color' => ['required'],
        ]);
        $id = $request->id;
        $title = $request->title;
        $text = $request->text;
        $color = $request->color;

        $slider = slider::findOrFail($id);
        $slider->title = $title;
        $slider->text = $text;
        $slider->color = $color;

        if ($request->image) {
            //delete image od storage
            $image_delete = $slider->image_path;
            Storage::delete($image_delete);

            //get information of new image
            $image = $request->image;
            $image_path = time() . $image->getClientOriginalName();
            $image_upload = File::get($image);

            //save in storage image
            Storage::put($image_path, $image_upload);

            $slider->image_path = $image_path;
        }
        $slider->update();
    }

    public function destroy($id) {
        $slider = slider::findOrFail($id);
        $slider->delete();
    }

}
