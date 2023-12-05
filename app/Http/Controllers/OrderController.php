<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use App\Models\MaterialModel;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderPage()
    {
        $materials = MaterialModel::latest()->get();
        return view('order', compact(["materials"]));
    }

    public function orderBillet( Request $request )
    {
        $request["tanggal_order"] = Carbon::now()->toDateString();

        try {
            DB::beginTransaction();
            $makeOrder = OrderModel::create($request->all());
            // DB::commit();
            $orderBillet = OrderModel::where('material_id', $request->material_id);
            $orderData = $orderBillet->first();
            $orderID = $orderData->id;
            $orderData->order_id = $orderID;

            if ($orderData) {
                $orderData->save();
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

    public function statusOrder()
    {
        $billetOrders = OrderModel::all();
        return view('statusOrder', compact(["billetOrders"]));
    }

    public function konfirmasiStatus($id, Request $request)
    {
        $ubahStatus = $request->input("status");

        $order = OrderModel::find($id);
        $order->status = $ubahStatus;
        $order->save();
        return redirect()->back();

        // $ubahStatus = $request->input("status");
        // DB::table("order_billet")
        // ->where('order_id', $id)
        // ->update([
        //     'status' => $ubahStatus
        // ]);
        // return redirect()->back();
    }
}
