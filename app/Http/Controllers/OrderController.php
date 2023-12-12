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

        $diameter = $request["diameter_billet"];
        $jumlahBillet = $request["quantity"];
        
        // Generate batch number for the current order
        $batchNumber = $this->generateBatchNumber("D".$diameter."-", $jumlahBillet);
        // Update batch_number in the order
        $request["batch"] = $batchNumber;

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

    private function generateBatchNumber($diameterPrefix, $totalBillet)
    {
        // Check if the last batch is full based on the diameter
        $maxBilletForDiameter = $this->getMaxBilletForDiameter($diameterPrefix);
    
        // Get the total quantity for the current batch
        $batches = OrderModel::where('batch', 'like', $diameterPrefix . '%')
            ->selectRaw('batch, sum(quantity) as totalQuantity')
            ->groupBy('batch')
            ->get();

        foreach ($batches as $batch) {
            // Check if adding the new quantity to the existing total quantity in the current batch exceeds the maximum limit
            if ($batch->totalQuantity + $totalBillet <= $maxBilletForDiameter) {
                // Use the existing batch
                return $batch->batch;
            }
        }
    
        // If no batch is available or all batches are full, create a new batch
        $newBatchNumber = $this->getNewBatchNumber($diameterPrefix);
        return $newBatchNumber;
    }

    private function getNewBatchNumber($diameterPrefix)
    {
        // Get the last batch number for the given diameter prefix
        $lastBatchNumber = OrderModel::where('batch', 'like', $diameterPrefix . '%')
            ->orderByDesc('created_at')
            ->value('batch');

        // Mengekstrak angka terakhir menggunakan ekspresi reguler
        preg_match('/(\d+)$/', $lastBatchNumber, $matches);

        // Jika ada angka yang ditemukan, tambahkan 1, jika tidak, mulai dari 1
        $nextDigit = isset($matches[1]) ? $matches[1] + 1 : 1;

        // Menggabungkan dengan $diameterPrefix untuk mendapatkan $newBatchNumber
        $nextBatchNumber = $diameterPrefix . $nextDigit;
        // Generate the new batch number
        return $nextBatchNumber;
    }

    private function getMaxBilletForDiameter($diameterPrefix)
    {
        switch ($diameterPrefix) {
            case 'D5-':
                return 96;
            case 'D7-':
                return 52;
            case 'D8-':
                return 32;
            default:
                return 0; // Handle other cases as needed
        }
    }


    public function statusOrder()
    {
        $billetOrderGroups = OrderModel::select('batch')
            ->groupBy('batch')
            ->selectRaw('batch, sum(quantity) as totalQuantity')
            ->get();

        $billetOrders = OrderModel::get();
        return view('statusOrder', compact(["billetOrders"],["billetOrderGroups"]));
    }

    public function konfirmasiStatus($id, Request $request)
    {
        $ubahStatus = $request->input("status");

        $order = OrderModel::find($id);
        $order->status = $ubahStatus;
        if ($order->status === "pemotongan panjang") {
            $order->durasi_pemotongan_panjang = now()->addMinutes(1)->toTimeString();
        } elseif ($order->status === "pemotongan diameter") {
            $order->durasi_pemotongan_panjang = now()->addMinutes(1)->toTimeString();
        }
        $order->save();
        return redirect()->back();
    }

    

    
}
