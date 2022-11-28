<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\MaritalStatus;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with(['jobtitle', 'status', 'maritalstatus'])->get();
        if (Gate::allows('isEmployee')) {
            $employees = $employees->where('id', auth()->user()->employee_id);
        }
        return view('admin/employee/index', [
            'title' => 'Employee',
            'active' => 'employee',
            'page' => 'Employee',
            'employees' => $employees,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/employee/create', [
            'title' => 'Add New Employee',
            'active' => 'employee',
            'page' => 'Add New Employee',
            'employee' => new Employee(),
            'jobtitles' => JobTitle::all(),
            'maritalstatuses' => MaritalStatus::all(),
            'statuses' => Status::all(),
            'button_name' => 'Save',

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->only(['name', 'nik', 'phone', 'gender', 'jobtitle_id', 'status_id', 'maritalstatus_id']);
        if (!empty($request->pin)) {
            $data['pin'] = bcrypt($request->pin);
        }
        Employee::create($data);
        return redirect('employee')->with('success', 'Successfully added new Employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        return view('admin/employee/edit', [
            'title' => 'Edit Employee',
            'active' => 'employee',
            'page' => 'Edit Employee',
            'employee' => $employee->load('faces'),
            'jobtitles' => JobTitle::all(),
            'maritalstatuses' => MaritalStatus::all(),
            'statuses' => Status::all(),
            'button_name' => 'Update',

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->only(['name', 'gender', 'phone', 'jobtitle_id', 'status_id', 'maritalstatus_id']);
        if (!empty($request->pin)) {
            $data['pin'] = bcrypt($request->pin);
        }

        $employee->update($data);
        return redirect('employee')->with('success', 'Successfully changed employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect('employee')->with('success', 'Successfully delete employee');
    }
}
