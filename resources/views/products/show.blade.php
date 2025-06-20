@extends('layouts.app')

@section('title', '商品列表')

@section('content')

    <h1>{{ $product->name }}</h1>

    @php
        $categoryLabels = [
            'electronics' => '電子產品',
            'book' => '書籍',
            'food' => '食品'
        ];
    @endphp

    <p><strong>價格：</strong>${{ $product->price }}</p>
    <p><strong>庫存：</strong>{{ $product->stock }}</p>
    <p><strong>分類：</strong>{{ $categoryLabels[$product->category] }}</p>
    <p><strong>描述：</strong>{{ $product->description }}</p>

    <a href="{{ route('products.edit', $product->id) }}">編輯</a>

<!-- 
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('確定要刪除這個商品嗎？')">刪除</button>
    </form> 
-->


    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline" class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit">刪除</button>
    </form>
    <br><br>

    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary btn-sm">加入購物車</button>
    </form>
    <a href="{{ route('products.index') }}">返回列表</a>

@endsection