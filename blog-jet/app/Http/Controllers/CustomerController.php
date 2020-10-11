<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Customer::all();
        return Inertia::render('Customers', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'code_cust' => ['required'],
            'name_cust' => ['required'],
        ])->validate();

        Customer::create($request->all());

        return redirect()->back()
                    ->with('message', 'Customer Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'code_cust' => ['required'],
            'name_cust' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Customer::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Customer Updated Successfully.');
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
            Customer::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
