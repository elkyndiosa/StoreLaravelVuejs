<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use App\User;

class AddressController extends Controller
{
    public function index(){
        //
    }
    public function create(Request $request){
        $validate = $this->validate($request, [
            'municipality'=> ['required'],
            'neighborhood'=> ['required'],
            'adress'=> ['required']
        ]);
        $municipality = ucfirst($request->municipality);
        $neighborhood = ucfirst($request->neighborhood);
        $adress = ucfirst($request->adress);
        
        $adressFull = new Address();
        $adressFull->municipality = $municipality;
        $adressFull->neighborhood = $neighborhood;
        $adressFull->address = $adress;
        $adressFull->save();
        
        $lastAdress = Address::latest('id')->first();
        $user = User::findOrFail(\Auth()->user()->id);
        $user->address_id = $lastAdress->id;
        $user->update();
        Return redirect()->route('user.index');
    }
    public function get($id){
        $adress = Address::findOrFail($id);
        return $adress;
    }
}
