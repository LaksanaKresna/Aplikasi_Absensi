@extends('layouts.front')

@section('content')
<section class="ftco-menu mb-5 pb-5">
    <div class="container">
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            @foreach ($categories as $category)
                            <a class="nav-link @if ($loop->index==0) active @endif" id="v-pills-{{ $category->id }}-tab" data-toggle="pill" href="#v-pills-{{ $category->id }}"
                                role="tab" aria-controls="v-pills-{{ $category->id }}" aria-selected="true">{{ $category->name }}</a>
                            @endforeach
                           
                        </div>
                    </div>
                    <div class="col-md-12 d-flex align-items-center">

                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            @foreach ($categories as $category)
                                
                            <div class="tab-pane fade @if($loop->index==0) active show @endif" id="v-pills-{{ $category->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $category->id }}-tab">
                                <div class="row">
                                    @foreach ($category->products as $item)
                                        
                                    
                                    <div class="col-md-4 text-center">
                                        <div class="menu-wrap">
                                            <a href="#" class="menu-img img mb-4" style="background-image: url({{ Storage::url($item->image) }});"></a>
                                            <div class="text">
                                                <h3><a href="#">{{ $item->name }}</a></h3>
                                                <p>{{ $item->description }}</p>
                                                <p class="price"><span>{{ number_format($item->price) }}</span></p>
                                                <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id }}" name="id">
                                                    <input type="hidden" value="{{ $item->name }}" name="name">
                                                    <input type="hidden" value="{{ $item->price }}" name="price">
                                                    <input type="hidden" value="{{ $item->image }}" name="image">
                                                    <input type="hidden" value="1" name="quantity">
                                                    <button class="btn btn-primary btn-outline-primary">Beli</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    
                                </div>
                                
                            </div>
                            
                           
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush