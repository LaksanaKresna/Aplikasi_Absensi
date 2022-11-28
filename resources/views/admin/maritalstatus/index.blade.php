@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $page }}</p>
                <div class="row">
                    <div class="col-12">
                        <a class="my-3 btn btn-sm btn-success float-right" href="{{ route('maritalstatus.create') }}">Add New</a>
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Jobtitle
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
                                    @foreach ($maritalstatuses as $maritalstatus)
                                
                                
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                      
                                        <td>
                                            {{ $maritalstatus->name }}
                                        </td>
                                        <td>
                                            {{ $maritalstatus->created_at }}
                                        </td>
                                
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                
                                                <a href="{{ route('maritalstatus.edit',$maritalstatus->id) }}" class="btn btn-sm btn-primary m-1">Edit</a>
                                                <form action="{{ route('maritalstatus.destroy',$maritalstatus->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="return confirm('Are You Sure ?')"
                                                        class="btn btn-sm btn-danger m-1">Delete</button>
                                                </form>
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