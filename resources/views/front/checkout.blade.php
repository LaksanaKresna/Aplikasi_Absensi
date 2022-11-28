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
                                
                                <th>Pesanan</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaction->trxdetail as $item)
                            <tr class="text-center">
                               
                
                                <td class="product-name">
                                    <h3>{{ $item->product_name }}</h3>
                                    
                                </td>
                
                                <td class="price">{{ number_format($item->product_price) }}</td>
                
                                <td class="quantity">
                                   {{ $item->product_qty }}
                
                
                                </td>
                
                                <td class="total">{{ number_format($item->product_subtotal) }}</td>
                            </tr><!-- END TR-->
                            @endforeach
                            <tr class="text-right">
                                <td class="price">Ppn</td>
                                <td colspan="3" class="price">{{ number_format($transaction->tax) }}</td>
                            </tr>
                            <tr class="text-right">
                                <td class="price">Total</td>
                                <td colspan="3" class="price">{{ number_format($transaction->total) }}</td>
                            </tr>
                
                        </tbody>
                    </table>
                </div>
                <div style="background-color: white;" class="text-center p-4">
                    {{ QrCode::generate($transaction->id); }}
                </div>
                <p class="text-center">Silahkan menuju kasir untuk melakukan pemesanan, Terimakasih.</p>
            </div>
        </div>
        
    </div>
</section>
@endsection
@push('scripts')

@endpush