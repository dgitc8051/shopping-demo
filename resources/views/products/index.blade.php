@extends('layouts.app')

@section('title', '商品列表')

@section('content')
    <h1>所有商品</h1>
    <a href="{{ route('products.create') }}">新增商品</a>

    @php
        $categoryLabels = [
            'electronics' => '電子產品',
            'book' => '書籍',
            'food' => '食品'
        ];
    @endphp

    <ul>
        @foreach ($products as $product)
            <li>
                <p>
                    <strong>{{ $product->name }}</strong><br>
                    價格：${{ $product->price }}<br>
                    庫存：{{ $product->stock }}<br>
                    分類：{{ $categoryLabels[$product->category]}}<br>
                    商品描述:{{ $product->description }}
                </p>
                <a href="{{ route('products.show', $product->id) }}">查看</a>
                |
                <a href="{{ route('products.edit', $product->id) }}">編輯</a>


                <!-- 刪除表單：加入前端確認（confirm）提示，避免誤刪 -->
                <!-- <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('確定要刪除嗎？')">刪除</button>
                </form> -->

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline"
                    class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">刪除</button>
                </form>
                <hr>
            </li>
        @endforeach
    </ul>

    <div class="d-grid gap-2 mt-4">
        <a href="{{ route('cart.index') }}" class="btn btn-primary">查看購物車</a>
    </div>

@endsection