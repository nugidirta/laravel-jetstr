<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Validator;


class WarehouseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Warehouse::all();
        return Inertia::render('Warehouses', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'code_wh' => ['required'],
            'function_wh' => ['required'],
            'name_wh' => ['required'],
        ])->validate();

        Warehouse::create($request->all());

        return redirect()->back()
                    ->with('message', 'Warehouse Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'code_wh' => ['required'],
            'function_wh' => ['required'],
            'name_wh' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Warehouse::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Warehouse Updated Successfully.');
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
            Warehouse::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
