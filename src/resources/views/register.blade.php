@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-content">
    <div class="register-heading">
        <p>商品登録</p>
    </div>
    <div class="register-form">
        <form class="input-form" action="/products/register" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-form__group">
                <span class="input-form__group-title">商品名</span>
                <span class="input-form__group-required">必須</span>
                <div class="input-form__group-text">
                    <input class="input-form__group-text--box" type="text" name="name" placeholder="商品名を入力" value="{{ old('name') }}" />
                </div>
                <div class="form__error">
                    @error('name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="input-form__group">
                <span class="input-form__group-title">値段</span>
                <span class="input-form__group-required">必須</span>
                <div class="input-form__group-text">
                    <input class="input-form__group-text--box" type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
                </div>
                <div class="form__error">
                    @error('price')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="input-form__group">
                <span class="input-form__group-title">商品画像</span>
                <span class="input-form__group-required">必須</span>
                <div class="input-form__group-file">
                    <input class="input-form__group-file--button" type="file" name="img_file">
                </div>
                <div class="form__error">
                    @error('ime_file')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="input-form__group">
                <span class="input-form__group-title">季節</span>
                <span class="input-form__group-required">必須</span>
                <span class="input-form__group-multiple">複数選択可</span>
                <div class="input-form__group-season">
                    <input class="input-form__group-season--option" type="checkbox" name="season[]" value="1">
                    <label class="input-form__group-season--label" for="season_id">春</label>
                    <input class="input-form__group-season--option" type="checkbox" name="season[]" value="2">
                    <label class="input-form__group-season--label" for="season_id">夏</label>
                    <input class="input-form__group-season--option" type="checkbox" name="season[]" value="3">
                    <label class="input-form__group-season--label" for="season_id">秋</label>
                    <input class="input-form__group-season--option" type="checkbox" name="season[]" value="4">
                    <label class="input-form__group-season--label" for="season_id">冬</label>
                </div>
                <div class="form__error">
                    @error('season')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="input-form__group">
                <span class="input-form__group-title">商品説明</span>
                <span class="input-form__group-required">必須</span>
                <div class="input-form__group-text">
                    <textarea class="input-form__group-text--area" name="description" cols="72" rows="6" placeholder="商品の説明を入力" value="{{ old('description') }}" ></textarea>
                </div>
                <div class="form__error">
                    @error('description')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <div class="input-form__button">
                <a class="input-form__button-reverse" href="/products">戻る</a>
                <button class="input-form__button-submit" type="submit">登録</div>
            </div>
        </form>
    </div>
</div>
@endsection