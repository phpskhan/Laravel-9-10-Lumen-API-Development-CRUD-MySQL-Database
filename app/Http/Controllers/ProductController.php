<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Get - All Data from Database

        $products = Product::all();
        return response()->json($products);

    }

    public function store(Request $request)
    {
        // Post Data from Database

        //validation

        $this->validate($request,[
            'title' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);

        $product = new Product();

        //Image

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedFileExtension = ['pdf','png','jpg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if ($check) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            }
        }

        //Text data

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();

        return response()->json($product);
    }

    public function show($id)
    {
        // Get Single Record from Database
        $product = Product::find($id);
        return response()->json($product);

    }

    public function update(Request $request, $id)
    {
        // Update Single Record in the Database

        //validation

        $this->validate($request,[
            'title' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required'
        ]);

        $product = Product::find($id);

        //Image

        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $allowedFileExtension = ['pdf','png','jpg'];
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedFileExtension);

            if ($check) {
                $name = time() . $file->getClientOriginalName();
                $file->move('images', $name);
                $product->photo = $name;
            }
        }

        //Text data

        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');

        $product->save();

        return response()->json($product);

    }

    public function destroy($id)
    {
        // Delete Single Record in the Database
        $product = Product::find($id);
        $product->delete();
        return response()->json("Product Deleted Successfully");
    }

    public function list()
    {
        $product = Product::all();
        return view('list', ['products'=>$product]);
    }
}
