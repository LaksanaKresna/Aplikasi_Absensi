@extends('layouts.admin2')

@section('content')

<div class="row">

<div class="col-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $page }}</h4>
            <form class="form-sample" autocomplete="off" action="{{ route('maritalstatus.store') }}" method="POST">
                @csrf
                
                @include('admin.maritalstatus._form')
                
               
            </form>
        </div>
    </div>
</div>
</div>
@endsection