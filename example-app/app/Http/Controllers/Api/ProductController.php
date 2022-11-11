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
            'precio' => 'required',
            'stock' => 'required',

        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->precio = $request->precio;
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

        $res = Product::find($request)->each->delete();
        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha borrado el producto'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha borrado el producto'
            ];
        }
        return response()->json($data);
    }

    public function updateProduct(Request $request)
    {
        $request->validate(['id' => 'required', 'name' => 'required', 'description' => 'required']);
            
        $post = Product::updateOrCreate(
            ['name' => $request->name, 'description' => $request->description],
            ['id' => $request->id]
        );
        if ($post) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha actualizado el producto'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha actualizado el producto'
            ];
        }
        return response()->json($data);
    }
    
    public function readProduct(Request $request) {
        $posts = Product::all();

        return response()->json($posts);
    }
}
