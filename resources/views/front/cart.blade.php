
@extends('layouts.front')

@section('content')
<section class="ftco-section ftco-cart">

    <div class="container">
        <div class="row">
            <div class="col-md-12 ftco-animate fadeInUp ftco-animated">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Pesanan</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr class="text-center">
                                <td class="product-remove">
                                    <form action="{{ route('cart.remove') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $item->id }}" name="id">
                                        <button class="btn btn-secondary" style="height: auto !important;"><span class="icon-close"></span></button>
                                    </form>
                                </td>

                                <td class="image-prod">
                                    <div class="img" style="background-image:url({{ Storage::url($item->attributes->image)  }});"></div>
                                </td>

                                <td class="product-name">
                                    <h3>{{ $item->name }}</h3>
                                    
                                </td>

                                <td class="price">{{ number_format($item->price) }}</td>

                                <td class="quantity">
                                        <form class="d-flex justify-content-between" action="{{ route('cart.update') }}" method="POST">
                                        <div class="input-group mb-3">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id}}">
                                                <input type="number" name="quantity" class="quantity form-control input-number" value="{{ $item->quantity }}"
                                                    min="1" max="100">
                                                
                                                
                                            </div>
                                            <button type="submit" class="btn btn-primary" style="color: azure !important;padding: 5px;">Ubah</button>
                                        </form>
                              
                                    
                                </td>

                                <td class="total">{{ number_format($item->getPriceSum()) }}</td>
                            </tr><!-- END TR-->
                            @endforeach
                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col col-lg-3 col-md-6 mt-5 cart-wrap ftco-animate fadeInUp ftco-animated">
                <div class="cart-total mb-3">
                    <h3>Total Pesanan</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span>{{ number_format(Cart::getTotal()) }}</span>
                    </p>
                    <p class="d-flex">
                        <span>Ppn</span>
                        <span>{{ number_format(round(Cart::getTotal()*10/100)) }}</span>
                    </p>
                    
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span>{{ number_format(round(Cart::getTotal()*10/100)+Cart::getTotal()) }}</span>
                    </p>
                </div>
                <p class="text-center">
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <button @if (Cart::getTotalQuantity()==0)
                            disabled
                        @endif class="btn btn-primary py-3 px-4" onclick="return confirm('Pesanan sudah sesuai semua?')" style="color:#ccc!important;">Proses Pesanan</button>
                    </form>
                    
                </p>
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf
                    <button class="btn btn-secondary py-3 px-4" style="color:#ccc!important;width:100%;">Hapus Semua</button>
                </form>
                
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush