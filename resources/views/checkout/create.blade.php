@extends('layouts.app')

@section('title', '結帳')

@section('content')
    <h1>結帳資訊</h1>


    @if (empty($cart))
        <p>目前購物車是空的，請先選購商品。</p>
        <a href="{{route('products.index')}}">返回列表</a>
    @else

        @if ($errors->has('cart'))
            <div class="alert alert-danger">
                {{ $errors->first('cart') }}
            </div>
        @endif

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
                    <form action="{{ route('checkout.remove', $id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">移除</button>
                    </form>

                    <hr>
                </li>
            @endforeach
            <h4>總計:${{ number_format($total) }}</h4>
        </ul>



        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf

            <div class="mb-3">

                <label for="name">收件人姓名:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                    class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div id="name-error-js" class="invalid-feedback" style="display: none;">
                    請輸入收件人姓名
                </div>
            </div>

            <div class="mb-3">
                <label for="phone">電話:</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="form-control @error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div id="phone-error-js" class="invalid-feedback" style="display:none">
                    請輸入電話
                </div>
            </div>

            <div class="mb-3">
                <label for="address">地址:</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}"
                    class="form-control @error('address') is-invalid @enderror">
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div id="address-error-js" class="invalid-feedback" style="display:none">
                    請輸入地址
                </div>
            </div>

            <div class="mb-3">
                <label for="payment" class="form-label">付款方式:</label>
                <select name="payment" id="payment" class="form-select @error('payment') is-invalid
                @enderror">
                    <option value="">請選擇:</option>
                    <option value="cod" {{ old('payment') == 'cod' ? 'selected' : '' }}>貨到付款</option>
                    <option value="credit" {{ old('payment') == 'credit' ? 'selected' : '' }}>信用卡</option>
                </select>
                @error('payment')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
                <div id="payment-error-js" class="invalid-feedback" style="display:none">
                    請選擇付款方式
                </div>
            </div>

            <button type="submit" class="btn btn-success" id="submit-btn">送出訂單</button>
        </form>
        <div class="d-grid gap-2 mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary">繼續購物</a>
        </div>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fields = ['name', 'phone', 'address', 'payment'];

            fields.forEach(field => {
                const input = document.getElementById(field);
                const errorDiv = document.getElementById(`${field}-error-js`);

                if (input && errorDiv) {
                    input.addEventListener('blur', function () {
                        if (input.value.trim() === '') {
                            input.classList.add('is-invalid');
                            errorDiv.style.display = 'block';
                        } else {
                            input.classList.remove('is-invalid');
                            errorDiv.style.display = 'none';
                        };
                    });
                }
            });
        })
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn');

            if (form && submitBtn) {
                form.addEventListener('submit', function () {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm"></span>請稍等...`
                });
            }
        });
    </script>
@endsection