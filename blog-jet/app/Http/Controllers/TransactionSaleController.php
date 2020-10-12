<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\TransactionSale;
use App\Models\TransactionSaleDetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

            $transaction = TransactionSale::create($request->all());

            $lineno = 1;
            $subtotal = 0;
            foreach ($request->detail as $row) {

                if (!is_null($row['price'])) {
                    $total = $row['price'] * $row['quantity'];

                    TransactionSaleDetail::create([
                        'line_no' => $lineno,
                        'transaction_no' => $transaction->id,
                        'item_code' => $row['item_code'],
                        'unit_code' => $row['unit_code'],
                        'quantity' => $row['quantity'],
                        'price' => $row['price'],
                        'disc_pr' => $row['disc_pr'],
                        'disc_nom' => $row['disc_nom'],
                        'total' => $total,
                        'tax' => 0,
                    ]);

                    $lineno += 1;
                    $subtotal += $total;
                }

            }
            $transaction->update(['subtotal' => $subtotal]);
            DB::commit();

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

            DB::beginTransaction();
            try {

                $transaction = TransactionSale::find($request->input('id'))->update($request->all());

                $lineno = 1;
                $subtotal = 0;
                foreach ($request->detail as $row) {

                    if (!is_null($row['price'])) {
                        $total = $row['price'] * $row['quantity'];

                        TransactionSaleDetail::find($row['id'])->update([
                            'line_no' => $lineno,
                            'transaction_no' => $transaction->id,
                            'item_code' => $row['item_code'],
                            'unit_code' => $row['unit_code'],
                            'quantity' => $row['quantity'],
                            'price' => $row['price'],
                            'disc_pr' => $row['disc_pr'],
                            'disc_nom' => $row['disc_nom'],
                            'total' => $total,
                            'tax' => 0,
                        ]);

                        $lineno += 1;
                        $subtotal += $total;
                    }

                }
                $transaction->update(['subtotal' => $subtotal]);
                DB::commit();

                return redirect()->back()
                        ->with('message', 'Transaction Updated Successfully.');

            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()
                            ->with('message', 'Transaction Updated Error.');
            }
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
