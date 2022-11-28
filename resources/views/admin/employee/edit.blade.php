@extends('layouts.admin2')

@section('content')
<div class="row">

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $page }}</h4>
                <form class="form-sample" autocomplete="off" action="{{ route('employee.update',$employee->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @include('admin.employee._form')


                </form>
                @include('admin.employee._listface')
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
    <script>
        $('#gender').val(`{{ $employee->gender }}`)
        $('#jobtitle_id').val(`{{ $employee->jobtitle_id }}`)
        $('#maritalstatus_id').val(`{{ $employee->maritalstatus_id }}`)
        $('#status_id').val(`{{ $employee->status_id }}`)
    </script>
@endpush