@extends('layouts.admin2')

@section('content')

<div class="row">

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $page }}</h4>
            <form class="form-sample" autocomplete="off" action="{{ route('employeeface.store') }}" method="POST" id="fromEmployeeFace">
                @csrf
                
                @include('admin.employeeface._form')
                
               
            </form>
        </div>
    </div>
</div>
</div>
@endsection