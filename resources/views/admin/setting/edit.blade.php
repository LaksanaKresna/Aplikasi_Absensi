@extends('layouts.admin2')

@section('content')
<div class="row">

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ $page }}</h4>
                <form class="form-sample" autocomplete="off" action="{{ route('setting.update',$setting->id) }}"
                    method="POST">
                    @csrf
                    @method('put')
                    <div class="form-row">
                    
                        <div class="form-group col-md-6">
                            <label for="appname">App Name</label>
                            <input type="text" class="form-control @error('appname') is-invalid @enderror" id="appname" name="appname"
                                value="{{  old('appname', $setting->appname) }}" placeholder="Application Name">
                            @error('appname')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                                value="{{  old('address', $setting->address) }}" placeholder="Address">
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                                value="{{  old('phone', $setting->phone) }}" placeholder="Phone">
                            @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" name="latitude"
                                value="{{  old('latitude', $setting->latitude) }}" placeholder="Phone">
                            @error('latitude')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="longtitude">Latitude</label>
                            <input type="text" class="form-control @error('longtitude') is-invalid @enderror" id="longtitude" name="longtitude"
                                value="{{  old('longtitude', $setting->longtitude) }}" placeholder="Phone">
                            @error('longtitude')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="count_radius">Count Radius</label>
                            
                                <select name="count_radius" id="count_radius" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0" {{ $setting->count_radius==0 ?'selected':'' }}>No</option>
                                </select>
                            @error('count_radius')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="in_time">In Time</label>
                            
                                <input  class="form-control" type="time" name="in_time" id="in_time" value="{{ $setting->in_time }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="out_time">Out Time</label>
                            
                                <input class="form-control" type="time" name="out_time" id="out_time" value="{{ $setting->out_time }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Changes</button>


                </form>
               
            </div>
        </div>
    </div>
</div>

@endsection