<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;
use Illuminate\Support\Facades\Validator;


class ItemController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Item::all();
        return Inertia::render('Items', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'type_item' => ['required'],
            'code_item' => ['required'],
            'name_item' => ['required'],
            'brand_code' => ['required'],
            'unit_code' => ['required'],
            'warehouse_code' => ['required'],
        ])->validate();

        Item::create($request->all());

        return redirect()->back()
                    ->with('message', 'Item Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'type_item' => ['required'],
            'code_item' => ['required'],
            'name_item' => ['required'],
            'brand_code' => ['required'],
            'unit_code' => ['required'],
            'warehouse_code' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Item::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Item Updated Successfully.');
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
            Item::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
