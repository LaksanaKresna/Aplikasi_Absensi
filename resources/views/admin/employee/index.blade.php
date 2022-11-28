@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $page }}</p>
                <div class="row">
                    <div class="col-12">
                        <a class="my-3 btn btn-sm btn-success float-right" href="{{ route('employee.create') }}">Add New</a>
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            NIK
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Gender
                                        </th>
                                        <th>
                                            Job Title
                                        </th>
                                        <th>
                                            Marital Status
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                      
                                        <th>
                                            Created At
                                        </th>
                                        
                                        <th class="text-center">
                                            Options
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employees as $employee)
                                
                                
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                      
                                        <td>
                                            {{ $employee->nik }}
                                        </td>
                                        <td>
                                            {{ $employee->name }}
                                        </td>
                                        <td>
                                            {{ gender($employee->gender) }}
                                        </td>
                                        <td>
                                            {{ $employee->jobtitle->name }}
                                        </td>
                                        <td>
                                            {{ $employee->maritalstatus->name }}
                                        </td>
                                        <td>
                                            {{ $employee->status->name }}
                                        </td>
                                        
                                        <td>
                                            {{ $employee->created_at }}
                                        </td>
                                
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                
                                                <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-sm btn-primary m-1">Edit</a>
                                                @can('isAdmin')
                                                <form action="{{ route('employee.destroy',$employee->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Are You Sure ?')"
                                                        class="btn btn-sm btn-danger m-1">Delete</button>
                                                </form>
                                               
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection