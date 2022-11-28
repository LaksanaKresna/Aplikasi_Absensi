<div class="sidebar-wrapper">
    <ul class="nav">
        <li class="@if ($active=='dashboard') active @endif">
            <a href="{{ route('dashboard.index') }}">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="@if ($active=='category') active @endif">
            <a href="{{ route('category.index') }}">
                <i class="nc-icon nc-diamond"></i>
                <p>Kategori</p>
            </a>
        </li>
        <li class="@if ($active=='product') active @endif">
            <a href="{{ route('product.index') }}">
                <i class="nc-icon nc-shop"></i>
                <p>Produk</p>
            </a>
        </li>
        <li class="@if ($active=='transaction') active @endif">
            <a href="{{ route('transaction.index') }}">
                <i class="nc-icon nc-cart-simple"></i>
                <p>Transaksi</p>
            </a>
        </li>
        @if (auth()->user()->username=='admin')
            
        
        <li class="@if ($active=='user') active @endif">
            <a href="{{ route('user.index') }}">
                <i class="nc-icon nc-single-02"></i>
                <p>Pengguna</p>
            </a>
        </li>
        @endif
        <li class="@if ($active=='setting') active @endif">
            <a href="{{ route('setting.edit',1) }}">
                <i class="nc-icon nc-settings"></i>
                <p>Pengaturan</p>
            </a>
        </li>
        


    </ul>
</div>