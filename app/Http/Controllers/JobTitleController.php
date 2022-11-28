<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobTitleRequest;
use App\Models\JobTitle;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/jobtitle/index', [
            'title' => 'Job Title',
            'active' => 'jobtitle',
            'page' => 'Job Title',
            'jobtitles' => JobTitle::all(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/jobtitle/create', [
            'title' => 'Add New JobTitle',
            'active' => 'jobtitle',
            'page' => 'Add New JobTitle',
            'jobtitle' => new JobTitle(),
            'button_name' => 'Save',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobTitleRequest $request)
    {
        JobTitle::create($request->only('name'));
        return redirect('jobtitle')->with('success', 'Successfully added new jobtitle');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function show(JobTitle $jobtitle)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(JobTitle $jobtitle)
    {
        return view('admin/jobtitle/edit', [
            'title' => 'Edit JobTitle',
            'active' => 'jobtitle',
            'page' => 'Edit JobTitle',
            'jobtitle' => $jobtitle,
            'button_name' => 'Update',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function update(JobTitleRequest $request, JobTitle $jobtitle)
    {
        $jobtitle->update($request->only('name'));
        return redirect('jobtitle')->with('success', 'Successfully changed jobtitle');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobTitle  $jobTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobTitle $jobtitle)
    {
        $jobtitle->delete();
        return redirect('jobtitle')->with('success', 'Successfully delete jobtitle');
    }
}
