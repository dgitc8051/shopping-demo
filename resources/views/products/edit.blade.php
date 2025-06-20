@extends('layouts.app')

@section('title', '編輯商品')

@section('content')

    <h1>編輯商品</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">商品名稱：</label>
            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="name-error-js" class="invalid-feedback" style="display: none;">
                請輸入商品名稱
            </div>
        </div>

        <div class="mb-3">
            <label for="price">價格</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                class="form-control @error('price') is-invalid @enderror">
            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="price-error-js" class="invalid-feedback" style="display:none;">
                請輸入價格
            </div>
        </div>

        <div class="mb-3">
            <label for="stock">庫存數量：</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                class="form-control @error('stock') is-invalid @enderror">
            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="stock-error-js" class="invalid-feedback" style="display: none;">
                請輸入庫存數量
            </div>
        </div>

        <div class="mb-3">
            <label for="category">分類：</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                <option value="">-- 請選擇 --</option>
                <option value="electronics" {{ old('category', $product->category) == 'electronics' ? 'selected' : '' }}>電子產品
                </option>
                <option value="book" {{ old('category', $product->category) == 'book' ? 'selected' : '' }}>書籍</option>
                <option value="food" {{ old('category', $product->category) == 'food' ? 'selected' : '' }}>食品</option>
            </select>
            @error('category')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="category-error-js" class="invalid-feedback" style="display: none;">
                請輸入分類
            </div>
        </div>

        <div class="mb-3">
            <label for="description">商品描述:</label>
            <textarea name="description" id="description" rows="4" placeholder="請輸入商品描述"
                class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div id="description-error-js" class="invalid-feedback" style="display: none;">
                請輸入商品描述
            </div>
        </div>
        <button type="submit">更新商品</button>
        <a href="{{route('products.index')}}">返回列表</a>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = ['name', 'price', 'stock', 'category', 'description'];

            fields.forEach(function (field) {
                const input = document.getElementById(field);
                const errorDiv = document.getElementById(`${field}-error-js`);

                input.addEventListener('blur', function () {
                    if (input.value.trim() === '') {
                        input.classList.add('is-invalid');
                        errorDiv.style.display = 'block';
                    } else {
                        input.classList.remove('is-invalid');
                        errorDiv.style.display = 'none';
                    }
                })
            })
        })
    </script>
@endsection