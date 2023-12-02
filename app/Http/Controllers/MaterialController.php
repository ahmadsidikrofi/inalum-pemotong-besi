<?php

namespace App\Http\Controllers;

use App\Models\MaterialModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MaterialController extends Controller
{
    public function viewPage_createMaterial()
    {
        return view('createMaterial');
    }

    public function store_createMaterial( Request $request )
    {
        $material = MaterialModel::create($request->all());
        $gambar_material = $request->file("gambar_material");
        $fileName = $gambar_material->getClientOriginalName();
        $gambar_material = Image::make($gambar_material)->resize(1280, 720);
        $gambar_material->save("assets/images/".$fileName);
        $material->gambar_material = $fileName;
        $material->save();
        return redirect('/');
    }

    public function viewPage_editMaterial( $id )
    {
        $getMaterial = MaterialModel::find($id);
        return view('editMaterial', compact(["getMaterial"]));
    }

    public function store_editMaterial( $id, Request $request )
    {
        $editMaterial = MaterialModel::find($id);
        $editMaterial->update($request->all());

        $gambar_material = $request->file("gambar_material");
        if ($gambar_material) {
            $fileName = $gambar_material->getClientOriginalName();
            $gambar_material = Image::make($gambar_material)->resize(1280, 720);
            $gambar_material->save("assets/images/".$fileName);
            $editMaterial->gambar_material = $fileName;
            $editMaterial->save();
        }
        return redirect('/');
    }

    public function delete_material( $id )
    {
        MaterialModel::find($id)->delete();
        return redirect()->back();
    }
}
