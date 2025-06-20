@extends('layouts.app')

@section('title', '購物車')

@section('content')
    <h1>購物車內容</h1>

    @if(empty($cart))
        <p>目前購物車是空的。</p>
    @else
        <ul>
            @php $total = 0; @endphp
            @foreach ($cart as $id => $item)
                @php
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal; 
                @endphp
                <li>
                    {{ $item['name'] }}｜價格：${{ $item['price'] }}｜數量：{{ $item['quantity'] }}<br>
                    小計:${{ number_format($subtotal) }}
                    <form action="{{ route('cart.remove', $id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">移除</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <hr>
        <h4>總計:${{ number_format($total) }}</h4>
    @endif
    @if(!empty($cart))
        <form action="{{ route('cart.clear') }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning mb-4" onclick="return confirm('確定要清空購物車嗎?')">清空購物車</button>
        </form>
    @endif
    <a href="{{ route('products.index') }}">繼續購物</a>
@endsection