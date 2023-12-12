<?php

namespace App\Http\Controllers;

use App\Models\ConveyingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConveyingController extends Controller
{
    public function billetStacker()
    {
        $billetStackers = ConveyingModel::latest()->get();
        return view('conveyingEquipment.billetStacker', compact(["billetStackers"]));
    }

    public function billetStackerStore(Request $request)
    {
        try {
            DB::beginTransaction();
            ConveyingModel::create($request->all());
            $conveyBillet = ConveyingModel::where('order_id', $request->order_id)
            ->where('material_id', $request->material_id)
            ->first();

            $conveyID = $conveyBillet->id;
            $conveyBillet->conveying_id = $conveyID;
            if ($conveyBillet) {
                $conveyBillet->save();
            } else {
                dd("data tidak ditemukan");
            }

            DB::commit();
            return redirect()->back();
        } catch(\Throwable $throw) {
            DB::rollback();
            dd($throw);
        }
    }
}
