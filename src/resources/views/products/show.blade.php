@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
 <form action="/products/{{ $product->id }}/update" method="POST" enctype="multipart/form-data">
    @csrf
<div class="container product-detail">


    <p class="breadcrumb">
        <a href="/products">商品一覧</a> ＞ {{ $product->name }}
    </p>

    <div class="detail-wrapper">
        <div class="detail-image">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        </div>

        <div class="detail-form">
            <label>商品名</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}">
            @error('name')<p class="error">{{ $message }}</p> @enderror

            <label>値段</label>
            <input type="text" name="price" value="{{ old('price', $product->price) }}">
            @error('price')<p class="error">{{ $message }}</p> @enderror

           <label>季節</label>
           <div class="form__season-inputs">
           @foreach($seasons as $season)
           <label>
            <input type="checkbox" name="season_id[]" value="{{ $season->id }}"
            {{ in_array( $season->id, old( 'season_id', $product->seasons->pluck('id')->toArray() )) ? 'checked' : '' }}>
            {{ $season->name }}
            </label>
            @endforeach
            </div>
            @error('season_id')
              <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-detail">
            <label>商品説明</label>
            <textarea name="description">{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="error">{{ $message }}</p> @enderror

            <div class="btn-area">
             <a href="/products" class="back_btn btn">戻る</a>
               <input  class="save_btn btn" type="submit" value="変更を保存">
            </div>
        </div>
    </div>
</div>
</form>
@endsection
