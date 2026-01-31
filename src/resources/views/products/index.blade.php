@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="container">

   <div class="header-row">
    <h1>
        @if(request('keyword'))
            “{{ request('keyword') }}”の商品一覧
        @else
            商品一覧
        @endif
    </h1>
    <a href="/products/register" class="add-button">＋ 商品を追加</a>
    </div>

   <div class="product-page">
    <div class="product-controls">

    <form action="/products/search" method="GET">
        <input type="text" name="keyword" placeholder="商品名で検索" value="{{ request('keyword') }}">

        <button type="submit">検索</button>

        <p>価格順で表示</p>
        <select name="sort" onchange="this.form.submit()">
            <option value="">選択してください</option>
            <option value="high" {{ request('sort') === 'high' ? 'selected' : '' }}>高い順に表示</option>
            <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>低い順に表示</option>
        </select>
    </form>

    @if(request('sort'))
        <div class="sort-tag">
            {{ request('sort') === 'high' ? '高い順に表示' : '低い順に表示' }}
            <a href="{{ url()->current() }}">×</a>
        </div>
    @endif
    </div>

    <div class="product-list">
        @forelse($products as $product)
            <div class="product-card">
                <a href="/products/{{ $product->id }}">

                    <div class="product-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                    <p>{{ $product->name }}</p>
                    <p>¥{{ number_format($product->price) }}</p>
                    </div>
                </a>
            </div>
        @empty
            <p>該当する商品が見つかりませんでした。</p>
        @endforelse
    </div>
   </div>

    <div class="pagination-wrapper">
       <div class="pagination">
        {{ $products->links() }}
       </div>
    </div>

</div>
@endsection