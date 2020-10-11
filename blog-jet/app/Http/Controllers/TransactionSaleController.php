<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TransactionSale;
use App\Models\TransactionSaleDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransactionSaleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = TransactionSale::all();
        return Inertia::render('TransactionSales', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'no_transaction' => ['required'],
            'warehouse_code' => ['required'],
            'warehouse_from_code' => ['required'],
            'date_transaction' => ['required'],
            'customer_code' => ['required'],
        ])->validate();


        DB::beginTransaction();
        try {

            TransactionSale::create($request->all());

            $amount = 0;
            foreach ($request->detail as $row) {

                if (!is_null($row['price'])) {
                    $subtotal = $row['price']['price'] * $row['qty'];
                    if ($row['laundry_price']['unit_type'] == 'Kilogram') {
                        $subtotal = ($row['laundry_price']['price'] * $row['qty']) / 1000;
                    }

                    $start_date = Carbon::now();
                    $end_date = Carbon::now()->addHours($row['laundry_price']['service']);
                    if ($row['laundry_price']['service_type'] == 'Hari') {
                        $end_date = Carbon::now()->addDays($row['laundry_price']['service']);
                    }

                    TransactionSaleDetail::create([
                        'transaction_id' => $transaction->id,
                        'laundry_price_id' => $row['laundry_price']['id'],
                        'laundry_type_id' => $row['laundry_price']['laundry_type_id'],
                        'start_date' => $start_date->format('Y-m-d H:i:s'),
                        'end_date' => $end_date->format('Y-m-d H:i:s'),
                        'qty' => $row['qty'],
                        'price' => $row['laundry_price']['price'],
                        'subtotal' => $subtotal
                    ]);

                    $amount += $subtotal;
                }

            }

            return redirect()->back()
                        ->with('message', 'Transaction Created Successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                        ->with('message', 'Transaction Created Error.');
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'no_transaction' => ['required'],
            'warehouse_code' => ['required'],
            'warehouse_from_code' => ['required'],
            'date_transaction' => ['required'],
            'customer_code' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            TransactionSale::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Transaction Updated Successfully.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('id')) {
            TransactionSale::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
