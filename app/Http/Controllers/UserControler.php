<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\slider;
use App\Address;
use App\Category;


class UserControler extends Controller {

    public function index() {
        $sliders = slider::all();
        $currentUser = \Auth()->user();
        if($currentUser->address_id){
            $adress = Address::findOrFail($currentUser->address_id);
        }else{
            $adress = null;
        }
        $category = Category::orderBy('id', 'DESC')->get();
        $notification = ProductController::countProdS();
       
        return view('user', [
            'currentUser' => $currentUser,
            'sliders' => $sliders,
            'adress' => $adress,
            'category' => $category,
            'notification' => $notification
        ]);
    }

    public function get() {
        $currentUser = \Auth()->user();
        
        return $currentUser;
    }


    public function update(Request $request) {
        $validate = $this->validate($request, [
            'id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
            'municipality'=> ['required'],
            'neighborhood'=> ['required'],
            'adress'=> ['required']
        ]);
        $id = $request->id;
        $name = ucwords($request->name);
        $phone = $request->phone;
        $email = $request->email;
        
        $municipality = ucfirst($request->municipality);
        $neighborhood = ucfirst($request->neighborhood);
        $adress = ucfirst($request->adress);
        
        

        $user = User::findOrFail($id);
        $user->name = $name;
        $user->phone = $phone;
        $user->email = $email;
        $user->update();
        \Auth()->user()->name = $name;
        \Auth()->user()->email = $email;
        \Auth()->user()->phone = $phone;
        
        $adressFull = Address::findOrFail($user->address_id);
        $adressFull->municipality = $municipality;
        $adressFull->neighborhood = $neighborhood;
        $adressFull->address = $adress;
        $adressFull->update();
        return redirect()->route('user.index');
     
    }


}
