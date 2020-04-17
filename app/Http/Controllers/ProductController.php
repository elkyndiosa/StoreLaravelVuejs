<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Category;

class ProductController extends Controller {

    public function index() {
        $category = Category::orderBy('id', 'DESC')->get();
        $notification = $this->countProdS();
        return view('adminProduct', [
            'category' => $category,
            'notification' => $notification
        ]);
    }

    public function get() {
        $product = Product::where('status', '!=', 'Removed')->orderBy('id', 'DESC')->paginate(15);

        return [
            'pagination' => [
                'total' => $product->total(),
                'current_page' => $product->currentPage(),
                'per_page' => $product->perPage(),
                'last_page' => $product->lastPage(),
                'from' => $product->firstItem(),
                'to' => $product->lastItem(),
            ],
            'product' => $product
        ];
    }

    public function search($search) {
        $products = Product::where('status', '!=', 'Removed')
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orderBy('id', 'DESC')->take(10)->get();

        return $products;
    }

    public function getCategory($id_category) {
        $product = Product::where('category_id', $id_category)
                ->where('status', '!=', 'Removed')
                ->orderBy('id', 'DESC')
                ->paginate(5);
        return [
            'pagination' => [
                'total' => $product->total(),
                'current_page' => $product->currentPage(),
                'per_page' => $product->perPage(),
                'last_page' => $product->lastPage(),
                'from' => $product->firstItem(),
                'to' => $product->lastItem(),
            ],
            'product' => $product
        ];
    }

    public function create(Request $request) {
        //validate
        $validate = $this->validate($request, [
            'category' => ['required'],
            'name' => ['required', 'max:100', 'min:3'],
            'description' => ['required', 'max:200', 'min:15'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
        ]);
        //variable for data
        $image = $request->image;
        $category = $request->category;
        $name = ucfirst($request->name);
        $description = ucfirst($request->description);
        $price = $request->price;
        $stock = $request->stock;
        //change size of image
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            $imagejpg = File::get($image);
            Storage::put($image_path, $imagejpg);
        }

        //create object
        $product = new Product();
        $product->category_id = $category;
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->stock = $stock;
        $product->image_path = $image_path;
        $product->status = 'Active';

        //save object
        $product->save();
    }

    public function addCart(Request $request) {
        if(\Auth::check()) {
            if (!\Session::has('cart')) {
                \Session::put('cart', array());
            }
            $cart = \Session::get('cart');
            $cantCart = count($cart);
            if ($request->id != null) {
                if (isset($cantCart) and $cantCart > 0) {
                    $id_received = $request->id;
                    $x = 0;
                    $y = null;
                    foreach ($cart as $ca) {
                        if ($ca['id'] == $id_received) {
                            $y = $x;
                            $exists = TRUE;
                            break;
                        } else {
                            $exists = FALSE;
                        }
                        ++$x;
                    }

                    if ($exists) {
                        $cart[$y]['quantity'] = ++$cart[$y]['quantity'];
                        \Session::put('cart', $cart);
                        $cart2 = \Session::get('cart');
                        $countPCart = count($cart2);
                        return $countPCart;
                    }
                }


                $product = $request->all();
                array_push($cart, $product);
                \Session::put('cart', $cart);
                $cart2 = \Session::get('cart');
                $countPCart = count($cart2);
                return $countPCart;
            }
            return 'data empty';
        } else {
            return false;
        }
    }

    public function increase($id) {
        $cart = \Session::get('cart');
        $x = 0;
        $y = null;
        foreach ($cart as $ca) {
            if ($ca['id'] == $id) {
                $y = $x;
                break;
            }
            ++$x;
        }
        $cart[$y]['quantity'] = ++$cart[$y]['quantity'];
        \Session::put('cart', $cart);
        $cart2 = \Session::get('cart');
        $countPCart = count($cart2);
        return $countPCart;
    }

    public function decrease($id) {
        $cart = \Session::get('cart');
        $x = 0;
        $y = null;
        foreach ($cart as $ca) {
            if ($ca['id'] == $id) {
                $y = $x;
                break;
            }
            ++$x;
        }
        $cant = $cart[$y]['quantity'];
        if ($cant > 1) {
            $cart[$y]['quantity'] = --$cart[$y]['quantity'];
            \Session::put('cart', $cart);
            $cart2 = \Session::get('cart');
            $countPCart = count($cart2);
            return $countPCart;
        } else {
            return 'quantity minumun';
        }
    }

    public function getImage($id) {
        $product = Product::findOrFail($id);
        return $product->image_path;
    }

    public function edit(Request $request) {
        $validate = $this->validate($request, [
            'id' => ['required'],
            'name' => ['required', 'max:100'],
            'description' => ['required', 'max:300'],
            'price' => ['required', 'numeric'],
        ]);
        //variable for data
        $id = $request->id;
        if ($request->image) {
            $image = $request->image;
        };
        $name = $request->name;
        $description = ucfirst($request->description);
        $price = $request->price;

        $product = Product::findOrFail($id);
        if (isset($image)) {
            Storage::delete($product->image_path);
            $image_path = time() . $image->getClientOriginalName();
            $product->image_path = $image_path;
            $imagejpg = File::get($image);
            Storage::put($image_path, $imagejpg);
        };

        $product->name = $name;
        $product->description = $description;
        $product->price = $price;

        $product->update();
    }

    public static function countProdS() {
        if (\Session::has('cart')) {
            $cart = \Session::get('cart');
            $countPCart = count($cart);
            return $countPCart;
        }
        return 0;
    }

    public function getCart() {
        if (\Session::has('cart')) {
            $cart = \Session::get('cart');
            $total = 0;
            foreach ($cart as $c) {
                $costProduct = $c['quantity'] * $c['price'];
                $total = $total + $costProduct;
            }
            return [
                'total' => $total,
                'cart' => $cart
            ];
        }
        return null;
    }

    public function deleteProductCart($id) {
        $cart = \Session::get('cart');
        $x = 0;
        $y = '';
        foreach ($cart as $c) {
            if ($c['id'] == $id) {
                $y = $x;
            }
            $x = $x + 1;
        }
        unset($cart[$y]);
        $cart = array_values($cart);
        \Session::put('cart', $cart);
        return count($cart);
    }

    public function destroy($id) {

        $product = Product::findOrFail($id);
        $product->status = 'Removed';
        $product->update();
    }

}
