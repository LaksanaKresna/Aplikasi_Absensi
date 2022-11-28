<div class="row">
    <div class="col-12">
        <a class="my-3 btn btn-sm btn-success float-right" href="{{ route('employeeface.create') }}?id={{ $employee->id }}">Add New</a>
        
        <div class="table-responsive">
            <table class="display expandable-table" style="width:100%">
                <thead>
                    <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Face
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
                    @foreach ($employee->faces as $face)


                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            
                            <img src="{{ Storage::url($face->face ) }}" height="75" width="75" alt="" />
                        </td>
                       

                        <td>
                            {{ $face->created_at }}
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center">

                                <form action="{{ route('employeeface.destroy',$face->id) }}" method="post">
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
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Info!</strong> If you want to change photos, delete all photos first so the system can detect them properly. <br> Upload a picture of your face at least 2 pictures
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>