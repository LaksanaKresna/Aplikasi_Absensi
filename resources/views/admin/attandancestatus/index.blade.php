@extends('layouts.admin2')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title">{{ $page }}</p>
                <div class="row">
                    <div class="col-12">
                        <a class="my-3 btn btn-sm btn-success float-right" href="{{ route('attandancestatus.create') }}">Add New</a>
                        <div class="table-responsive">
                            <table class="display expandable-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>
                                            No
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
                                    @foreach ($attandancestatuses as $attandancestatus)
                                
                                
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                      
                                        <td>
                                            {{ $attandancestatus->name }}
                                        </td>
                                        <td>
                                            {{ $attandancestatus->created_at }}
                                        </td>
                                
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                
                                                <a href="{{ route('attandancestatus.edit',$attandancestatus->id) }}" class="btn btn-sm btn-primary m-1">Edit</a>
                                                <form action="{{ route('attandancestatus.destroy',$attandancestatus->id) }}" method="post">
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