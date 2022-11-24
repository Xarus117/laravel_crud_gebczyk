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

        $datos = Category::find($request)->each->delete();
        if ($datos) {
            $data = [
                "status" => "1",
                "msg" => "Se ha borrado la categoría"
            ];
        } else {
            $data = [
                "status" => "0",
                "msg" => "No se ha borrado la categoría"
            ];
        }
        return response()->json($data);
    }

    public function updateCategory(Request $request)
    {
        $request->validate(['id' => 'required', 'name' => 'required', 'description' => 'required']);

        $id = $request->id;
        $name = $request->name;
        $description = $request->description;

        $datos = Category::find($id);

        // Make sure you've got the Page model
        if ($datos) {
            $datos->name = "$name";
            $datos->description = "$description";
            $datos->save();
        }
        if ($datos) {
            $data = [
                "status" => "1",
                "msg" => "Se ha actualizado la categoría $datos->name"
            ];
        } else {
            $data = [
                "status" => "0",
                "msg" => "No se ha actualizado la categoría $datos->name"
            ];
        }
        return response()->json($data);
    }

    public function readCategory(Request $request)
    {
        $posts = Category::all();

        return response()->json($posts);
    }
}
