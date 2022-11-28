<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaritalStatusRequest;
use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/maritalstatus/index', [
            'title' => 'Marital Status',
            'active' => 'maritalstatus',
            'page' => 'Marital Status',
            'maritalstatuses' => MaritalStatus::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/maritalstatus/create', [
            'title' => 'Add New Marital Status',
            'active' => 'maritalstatus',
            'page' => 'Add New Marital Status',
            'maritalstatus' => new MaritalStatus(),
            'button_name' => 'Save',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaritalStatusRequest $request)
    {
        MaritalStatus::create($request->only('name'));
        return redirect('maritalstatus')->with('success', 'Successfully added new marital status');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function show(MaritalStatus $maritalStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(MaritalStatus $maritalstatus)
    {
        return view('admin/maritalstatus/edit', [
            'title' => 'Edit Marital Status',
            'active' => 'maritalstatus',
            'page' => 'Edit Marital Status',
            'maritalstatus' => $maritalstatus,
            'button_name' => 'Update',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaritalStatus $maritalstatus)
    {
        $maritalstatus->update($request->only('name'));
        return redirect('maritalstatus')->with('success', 'Successfully changed marital status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MaritalStatus  $maritalStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaritalStatus $maritalstatus)
    {
        $maritalstatus->delete();
        return redirect('maritalstatus')->with('success', 'Successfully delete marital status');
    }
}
