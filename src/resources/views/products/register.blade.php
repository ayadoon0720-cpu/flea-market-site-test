@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="form-container">
    <h1 class="title">商品登録</h1>

    <form action="/products" method="POST">
    @csrf

    <div class="form-group form__name-group">
      <label class="name__label">商品名 <span class="required">必須</span></label>
      <div class="form__name-inputs">
      <input type="text" name="name" value="{{ old('name') }}" placeholder="商品名を入力">
      </div>
      @error('name')
        <p class="error">{{ $message }}</p>
      @enderror
    </div>

    <div class="form-group form__price-group">
       <label class="price__label">値段 <span class="required">必須</span></label>
       <div class="form__price-inputs">
       <input type="text" name="price" value="{{ old('price') }}" placeholder="値段を入力">
       </div>
       @error('price')
        <p class="error">{{ $message }}</p>
       @enderror
    </div>

    <div class="form-group form__image-group">
       <label class="image__label">商品画像 <span class="required">必須</span></label>
       <div class="form__image-inputs">
       <input type="file" name="image">
       </div>
       @error('image')
        <p class="error">{{ $message }}</p>
       @enderror
    </div>

    <div class="form-group form__season-group">
       <label class="season__label">季節 <span class="required">必須</span><span class="multiple"> (複数選択可) </span></label>
       <div class="form__season-inputs">
       <label><input type="checkbox" name="season_id[]" value="1" {{ in_array(1, old('season_id', [])) ? 'checked' : '' }}> 春</label>

       <label><input type="checkbox" name="season_id[]" value="2" {{ in_array(2, old('season_id', [])) ? 'checked' : '' }}> 夏</label>

       <label><input type="checkbox" name="season_id[]" value="3" {{ in_array(3, old('season_id', [])) ? 'checked' : '' }}> 秋</label>

       <label><input type="checkbox" name="season_id[]" value="4" {{ in_array(4, old('season_id', [])) ? 'checked' : '' }}> 冬</label>
       </div>
       @error('season_id')
        <p class="error">{{ $message }}</p>
       @enderror
    </div>

    <div class="form-group form__description-group">
       <label class="description__label">商品説明 <span class="required">必須</span></label>
       <div class="form__description-inputs">
       <textarea name="description" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
       </div>
       @error('description')
        <p class="error">{{ $message }}</p>
       @enderror
    </div>

      <input  class="back_btn btn" type="submit" value="戻る">
      <input class="register_btn btn" type="submit" value="登録">

</form>
</div>
@endsection