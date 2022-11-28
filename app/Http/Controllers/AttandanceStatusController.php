<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttandanceStatusRequest;
use App\Models\AttandanceStatus;
use Illuminate\Http\Request;

class AttandanceStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/attandancestatus/index', [
            'title' => 'Attandance Status',
            'active' => 'attandancestatus',
            'page' => 'Attandance Status',
            'attandancestatuses' => AttandanceStatus::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/attandancestatus/create', [
            'title' => 'Add New AttandanceStatus',
            'active' => 'attandancestatus',
            'page' => 'Add New AttandanceStatus',
            'attandancestatus' => new AttandanceStatus(),
            'button_name' => 'Save',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttandanceStatusRequest $request)
    {
        AttandanceStatus::create($request->only('name'));
        return redirect('attandancestatus')->with('success', 'Successfully added new Attandance Status');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttandanceStatus  $attandancestatus
     * @return \Illuminate\Http\Response
     */
    public function show(AttandanceStatus $attandancestatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttandanceStatus  $attandancestatus
     * @return \Illuminate\Http\Response
     */
    public function edit(AttandanceStatus $attandancestatus)
    {
        return view('admin/attandancestatus/edit', [
            'title' => 'Edit Attandance Status',
            'active' => 'attandancestatus',
            'page' => 'Edit Attandance Status',
            'attandancestatus' => $attandancestatus,
            'button_name' => 'Update',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AttandanceStatus  $attandancestatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttandanceStatus $attandancestatus)
    {
        $attandancestatus->update($request->only('name'));
        return redirect('attandancestatus')->with('success', 'Successfully changed attandance status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttandanceStatus  $attandancestatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttandanceStatus $attandancestatus)
    {
        $attandancestatus->delete();
        return redirect('attandancestatus')->with('success', 'Successfully delete attandancestatus');
    }
}
