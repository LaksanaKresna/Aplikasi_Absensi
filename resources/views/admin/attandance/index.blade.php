@extends('layouts.admin2')

@section('content')
@push('styles')
    <link rel="stylesheet" href="/temp/skydash/vendors/select2/select2.min.css">
    <style>
        .select2-selection--single{
            height: 51px !important;
        }
        .select2-selection__arrow{
            height: 55px !important;
        }
    </style>
@endpush
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $page }}</p>
                <div class="row">
                    <div class="col-12">
                        
                        <a class="my-3 btn btn-sm btn-success float-right" href="{{ route('attandance.create.admin') }}">Add New</a>
                        <form class="form-inline">
                            <label class="sr-only" for="date1">date1</label>
                            <input type="date" class="form-control mb-2 mr-sm-2" id="date1" name="date1" placeholder="Start Date" required value="{{ request()->query('date1') }}">
                            <label class="sr-only" for="date2">date2</label>
                            <input type="date" class="form-control mb-2 mr-sm-2" id="date2" name="date2" placeholder="End Date" required value="{{ request()->query('date2') }}">
                            <label class="sr-only" for="employee">employee</label>
                            <select class="form-control mb-2 mr-sm-2 js-example-basic-single" id="employee" name="employee">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $e)
                                <option value="{{ $e->id }}">{{ $e->name }}</option>
                                    
                                @endforeach
                            </select>
                        
                            
                            <button type="submit" class="btn btn-primary mb-2 ml-5">Submit</button>
                            <a href="{{ \URL::full() }}&is_pdf=1" target="_blank" class="btn btn-info mb-2 ml-1">Reports</a>
                        </form>
                        
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
                                            In
                                        </th>
                                        <th>
                                            Out
                                        </th>
                                      
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                            Latitude
                                        </th>
                                        <th>
                                            Longtitude
                                        </th>
                                        <th>
                                            Distance(m)
                                        </th>
                                        <th>
                                            Desc
                                        </th>
                                        
                                        <th class="text-center">
                                            Options
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attandances as $att)
                                
                                
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                      
                                        <td>
                                            {{ @$att->employee->nik }}
                                        </td>
                                        <td>
                                            {{ @$att->employee->name }}
                                        </td>
                                        <td>
                                            {{ $att->att_in }}
                                        </td>
                                        <td>
                                            {{ $att->att_out }}
                                        </td>
                                        <td>
                                            {{ $att->att_date }}
                                        </td>
                                        
                                        <td>
                                            {{ $att->lat }}
                                        </td>
                                        <td>
                                            {{ $att->lng }}
                                        </td>
                                        <td>
                                            {{ $att->distance }}
                                        </td>
                                        <td>
                                            {{ $att->attandancestatus->name }}
                                        </td>
                                
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                
                                                <a href="{{ route('attandance.edit',$att->id) }}" class="d-none btn btn-sm btn-primary m-1">Edit</a>
                                                @can('isAdmin')
                                                <form action="{{ route('attandance.destroy',$att->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Are You Sure ?')"
                                                        class="btn btn-sm btn-danger m-1">Delete</button>
                                                </form>
                                                @else
                                                 -
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
@push('scripts')
    <script src="/temp/skydash/vendors/select2/select2.min.js"></script>
    <script>
        
        (function($) {
        'use strict';
        
        if ($(".js-example-basic-single").length) {
        $(".js-example-basic-single").select2();
        }
        if ($(".js-example-basic-multiple").length) {
        $(".js-example-basic-multiple").select2();
        }
        })(jQuery);
        $('#employee').val(`{{ request()->query('employee') }}`).change()
    </script>
@endpush
@endsection