<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Brand::all();
        return Inertia::render('Brands', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'code_brand' => ['required'],
            'description_brand' => ['required'],
        ])->validate();

        Brand::create($request->all());

        return redirect()->back()
                    ->with('message', 'Brand Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'code_brand' => ['required'],
            'description_brand' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Brand::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Brand Updated Successfully.');
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
            Brand::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
