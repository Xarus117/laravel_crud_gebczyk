<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function insertCategory(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return response()->json([
            "status" => 1,
            "msg" => "¡La categoría $category->name se ha guardado correctamente!!",
        ]);
    }

    public function destroyCategory(Request $request)
    {

        $request->validate([
            'id' => 'required'
        ]);

        $res = Category::find($request)->each->delete();
        if ($res) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha borrado la categoría'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha borrado la categoría'
            ];
        }
        return response()->json($data);
    }

    public function updateCategory(Request $request)
    {
        $request->validate(['id' => 'required', 'name' => 'required', 'description' => 'required']);
            
        $post = Category::updateOrCreate(
            ['name' => $request->name, 'description' => $request->description],
            ['id' => $request->id]
        );
        if ($post) {
            $data = [
                'status' => '1',
                'msg' => 'Se ha actualizado la categoría'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'No se ha actualizado la categoría'
            ];
        }
        return response()->json($data);
    }
    
    public function readCategory(Request $request) {
        $posts = Category::all();

        return response()->json($posts);
    }
}
