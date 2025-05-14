@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
<div class="detail">
    <div class="detail__heading">
        @error ('img_file')
         {{ $errors }}
        @enderror
        <a class="detail__heading-link" href="/products">商品一覧</a>
        <span class="detail__heading-productname"> > {{ $product['name'] }}</span> 
    </div>
    <div class="detail__content">
        <div class="detail__content-info">
          <form class="form" action="/products/{{ $productid }}/update" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="detail__content-info-group">    
                <span class="detail__content-info-img">
                    <img src="{{ asset( $product->image) }}" />
                    <div>
                        <input type="file" name="img_file" >
                    </div>
                </span>
                <span class="detail__content-info-items">
                    <div class="form-items__group">
                        <p>商品名</p>
                        <input type="text" name="name" value="{{ $product['name'] }}" />
                    </div>
                    <div class="form-items__group">
                        <p>値段</p>
                        <input type="text" name="price" value="{{ $product['price'] }}" />
                    </div>
                    <div class="form-items__group--season">
                        <p>季節</p>
                        <?php $i=0;
                              $count = count($product_seasons);
                              $spring = "0";
                              $summer = "0";
                              $autumn = "0"; ?>

                    @if ($count==4)
                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="1" checked />
                        <span>春</span>
                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" checked />
                        <span>夏</span>
                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                        <span>秋</span>
                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" checked />
                        <span>冬</span>
                    @else
                        @foreach ($product_seasons as $product_season)
                            <?php $i++; ?>
                            @if ($count==1)
                                <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="1" {{ $product_season->season_id == "1" ? "checked" : "" }} />
                               <span>春</span>
                                <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" {{ $product_season->season_id == "2" ? "checked" : "" }} />
                                <span>夏</span>
                                <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" {{ $product_season->season_id == "3" ? "checked" : "" }} />
                                <span>秋</span>
                                <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" {{ $product_season->season_id == "4" ? "checked" : "" }} />
                                <span>冬</span>
                                @continue
                            @elseif ($count==2)
                                @if ($i==1)
                                    @if ($product_season->season_id == "1")
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="1" checked />
                                        <span>春</span>
                                        <?php $spring = "1" ?>
                                        @continue
                                    @elseif ($product_season->season_id == "2")
                                        <input class="input-form__group-season--option"     type="checkbox"    name="season[]" value="1" />
                                        <span>春</span>
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" checked />
                                        <span>夏</span>
                                        <?php $summer = "1" ?>
                                        @continue
                                    @elseif ($product_season->season_id == "3")
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="1" />
                                        <span>春</span>
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" />
                                        <span>夏</span>
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                                        <span>秋</span>
                                        <?php $autumn = "1" ?>
                                        @continue
                                    @endif
                                    <!-- 季節が春～冬の順番の前提。このため季節が２つで１件目が冬のケースは想定無し -->
                                @elseif ($i==2)
                                    <!-- 同様に２件目で春のケースは想定無し -->
                                    @if ($product_season->season_id == "2")
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" checked />
                                        <span>夏</span>
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" />
                                        <span>秋</span>
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" />
                                        <span>冬</span>
                                        @continue
                                    @elseif ($product_season->season_id == "3")
                                        <!-- １件目が春の場合、夏の空チェックボックスを追加 -->
                                        @if($spring=="1")
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" />
                                            <span>夏</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                                            <span>秋</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" />
                                            <span>冬</span>
                                            @continue
                                        @else
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                                            <span>秋</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" />
                                            <span>冬</span>
                                            @continue
                                        @endif
                                    @elseif ($product_season->season_id == "4")
                                        <!-- １件目が春の場合、夏と秋の空チェックボックスを追加 -->
                                        @if ($spring=="1")
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" />
                                            <span>夏</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" />
                                            <span>秋</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" checked />
                                            <span>冬</span>
                                            @continue
                                        @elseif ($summer=="1")
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" />
                                            <span>秋</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" checked />
                                            <span>冬</span>
                                            @continue
                                        @elseif ($autumn=="1")
                                           <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" checked />
                                            <span>冬</span>
                                            @continue
                                        @endif
                                    @endif
                                @endif
                            @elseif ($count==3)
                                @if ($i==1)
                                    @if ($product_season->season_id == "1")
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="1" checked />
                                        <span>春</span>
                                        <?php $spring = "1" ?>
                                        @continue
                                    @elseif ($product_season->season_id == "2")
                                        <input class="input-form__group-season--option"     type="checkbox"    name="season[]" value="1" />
                                        <span>春</span>
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" checked />
                                        <span>夏</span>
                                        <?php $summer = "1" ?>
                                        @continue
                                    @endif
                                    <!-- ３つ季節がある場合、１件目が秋や冬になるケースは想定しない -->
                                @elseif ($i==2)
                                    <!-- 同様に２件目で春のケースは想定無し -->
                                    @if ($product_season->season_id == "2")
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" checked />
                                        <span>夏</span>
                                        <?php $summer = "1" ?>
                                        @continue
                                    @elseif ($product_season->season_id == "3")
                                        <!-- １件目が春の場合、夏の空チェックボックスを追加 -->
                                        @if($spring=="1")
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="2" />
                                            <span>夏</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                                            <span>秋</span>
                                            <?php $autumn = "1" ?>
                                            @continue
                                        @else <!-- １件目が夏の場合 -->
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                                            <span>秋</span>
                                            <?php $autumn = "1" ?>
                                            @continue
                                        @endif
                                    <!-- 全3件のケースで2件目が秋や冬の場合は想定無し -->
                                    @endif
                                @elseif($i==3)
                                    <!-- これまで同様の思想で３件目に春、夏のケースは想定無し -->
                                    @if ($product_season->season_id == "3")
                                        <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" checked />
                                        <span>秋</span>
                                        <input class="input-form__group-season--option"     type="checkbox"    name="season[]" value="4" />
                                        <span>冬</span>                                        
                                        @continue
                                    @elseif ($product_season->season_id == "4")
                                        @if($autumn=="1")
                                            <input class="input-form__group-season--option"     type="checkbox"    name="season[]" value="4" checked />
                                            <span>冬</span>
                                            @continue
                                        @else
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="3" />
                                            <span>秋</span>
                                            <input class="input-form__group-season--option" type="checkbox"    name="season[]" value="4" checked />
                                            <span>冬</span>
                                            @continue
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endif

                    </div>
                </span>
            </div>
            <div class="detail__content-info-description">
                <p>商品説明</p>
                <textarea class="input-form__group-text--area" name="description" cols="72" rows="6">{{ $product['description'] }}</textarea>
            </div>
            <div class="detail__footer">
                <a class="form-items__button-reverse" href="/products">戻る</a>
                <button class="form-items__button-submit" type="submit">変更を保存</button>
            </div>
          </form>
          <form class="form-delete" action="/products/{{ $productid }}/delete" method="post">
                @method('DELETE')
                @csrf
                <div class="form-delete__img">
                    <input 
                        class="form-delete__img-submit"
                        type="image"
                        name="productid"
                        width="30"
                        height="40" 
                        value="{{ $productid }}"
                       src="{{ asset('storage/delete_button_img.png') }}"
                        alt="削除"
                    />
                </div>
          </form>
        </div>
    </div>
</div>
@endsection