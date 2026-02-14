<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use App\Models\ReceiptPayment;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    
    public $prefix=1000;
    public $limit=100000;
    public function index()
    {
        return response()->json([
            'success' => true,
            'receipt' => "Hello World"], 200); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $token = $request->header('X-Token');
        $type="pharmacy";
        if($token=="8f6d9b2a4c7e1a9d3f0e5c8b7a4d6e9f2c1b0a8e7d6f5c4b3a2e1d9c8f7a6b"){
            $type="retail";
        };
          
        $data = $request->validate([
            'type'            => 'nullable|string',
            'shop'            => 'nullable|string',
            'pos'             => 'nullable|string',
            'cashier'         => 'nullable|string',
            'client'          => 'nullable|string',
            'receipt_no'      => 'nullable|string',
            'receipt_barcode' => 'nullable|string',
            'total'           => 'nullable|numeric|min:0',

            // 'items'            => 'required|array|min:1',
            // 'items.*.code'     => 'required|string',
            // 'items.*.name'     => 'required|string',
            // 'items.*.qty'    => 'required|numeric|min:0',
            // 'items.*.total'      => 'required|numeric|min:0.001',

            // 'payments'             => 'required|array|min:1',
            // 'payments.*.type'      => 'required|string',
            // 'payments.*.value'     => 'required|numeric|min:0.01',

        ]);
        if($data['total']<$this->limit){
            return response()->json([
                'success' => false,
                'data' => "Reciept total should be more then ".$this->limit,
            ], 500);
        };

        $receipt = Receipt::create([
            //'no'              => ($lastNo ?? 0) + 1,
            'type'            => $type,
            'shop'            => $data['shop'] ?? null,
            'pos'             => $data['pos'] ?? null,
            'cashier'         => $data['cashier'] ?? null,
            'client'          => $data['client'] ?? null,
            'receipt_no'      => $data['receipt_no'] ?? null,
            'receipt_barcode' => $data['receipt_barcode'] ?? null,
            'total'           => $data['total'] ?? 0,
        ]);

        $receipt->update([
            'no'=>$receipt->id+$this->prefix
        ]);
         // 📦 items
        if (!empty($data['items'])) {
            // items exists and not empty        }
            foreach ($data['items'] as $item) {
                ReceiptItem::create([
                    'receipt_id' => $receipt->id,
                    'code'       => $item['code'],
                    'name'       => $item['name'],
                    'qty'        => $item['qty'],
                    'total'      => $item['total'],
                ]);
            }
        }    
        // 💳 payments
        if (!empty($data['payments'])) {
            // items exists and not empty
        
            foreach ($data['payments'] as $payment) {
                ReceiptPayment::create([
                    'receipt_id' => $receipt->id,
                    'type'       => $payment['type'],
                    'value'      => $payment['value'],
                ]);
            }
        } 
        return response()->json([
            'success' => true,
            'data' => $receipt->load(['items', 'payments']),
        ], 201);   
       

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
