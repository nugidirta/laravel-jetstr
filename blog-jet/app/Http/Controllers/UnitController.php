<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Unit;
use Illuminate\Support\Facades\Validator;


class UnitController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = Unit::all();
        return Inertia::render('Units', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'code_unit' => ['required'],
            'description_unit' => ['required'],
        ])->validate();

        Unit::create($request->all());

        return redirect()->back()
                    ->with('message', 'Unit Created Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function update(Request $request)
    {
        Validator::make($request->all(), [
            'code_unit' => ['required'],
            'description_unit' => ['required'],
        ])->validate();

        if ($request->has('id')) {
            Unit::find($request->input('id'))->update($request->all());
            return redirect()->back()
                    ->with('message', 'Unit Updated Successfully.');
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
            Unit::find($request->input('id'))->delete();
            return redirect()->back();
        }
    }
}
