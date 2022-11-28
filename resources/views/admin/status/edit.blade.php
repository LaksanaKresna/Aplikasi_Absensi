@extends('layouts.admin2')

@section('content')
<div class="row">

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $page }}</h4>
                <form class="form-sample" autocomplete="off" action="{{ route('status.update',$status->id) }}" method="POST">
                    @csrf
                    @method('put')
                    @include('admin.status._form')


                </form>
            </div>
        </div>
    </div>
</div>


@endsection