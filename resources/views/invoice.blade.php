
<!-- resources/views/invoice.blade.php -->
<h1>Invoice</h1>
<h2>Subtotal: ${{ $subtotal }}</h2>
<h2>Shipping: ${{ $shippingFees }}</h2>
<h2>VAT: ${{ $vat }}</h2>
<h2>Discounts:</h2>
<ul>
    @foreach ($discounts as $name => $amount)
        <li>{{ $name }}: -${{ $amount }}</li>
    @endforeach
</ul>
<h2>Total: ${{ ($subtotal + $shippingFees + $vat) - array_sum($discounts) }}</h2>

@php
session()->forget('products_list')
@endphp

<a class="btn btn-success" href="{{ route('view.store') }}">back to Store</a>


