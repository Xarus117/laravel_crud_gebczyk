<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function insertProduct(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'stock' => 'required',

        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->stock = $request->stock;

        $product->save();

        return response()->json([
            "status" => 1,
            "msg" => "¡El producto $product->name se ha guardado correctamente!!",
        ]);
    }

    public function destroyProduct(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);

        $datos = Product::find($request)->each->delete();
        if ($datos) {
            $data = [
                "status" => "1",
                "msg" => "Se ha borrado el producto"
            ];
        } else {
            $data = [
                "status" => "0",
                "msg" => "No se ha borrado el producto"
            ];
        }
        return response()->json($data);
    }

    public function updateProduct(Request $request)
    {
        $request->validate(['id' => 'required', 'name' => 'required', 'description' => 'required', 'category' => 'required', 'price' => 'required', 'stock' => 'required']);

        $id = $request->id;
        $name = $request->name;
        $description = $request->description;
        $category = $request->category;
        $price = $request->price;
        $stock = $request->stock;

        $datos = Product::find($id);

        // Make sure you've got the Page model
        if ($datos) {
            $datos->name = "$name";
            $datos->description = "$description";
            $datos->category = "$category";
            $datos->price = "$price";
            $datos->stock = "$stock";
            $datos->save();
        }
        if ($datos) {
            $data = [
                "status" => "1",
                "msg" => "Se ha actualizado el producto $request->name"
            ];
        } else {
            $data = [
                "status" => "0",
                "msg" => "No se ha actualizado el producto $request->name"
            ];
        }
        return response()->json($data);
    }

    public function readProduct(Request $request)
    {
        $posts = Product::all();

        return response()->json($posts);
    }
}
