@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endsection

@section('content')
<div class="products__content">
    <div class="products-heading">
        <p class="products-heading__title">商品一覧</p>
        <span class="products-heading__link">
            <a class="products-heading__link-register" href="/products/register">+商品を追加</a>
        </span>
    </div>
    <div class="products-list">
        <div class="products-list__menu">
            <div class="search">
                <form class="search-form" action="/products/search" method="get">
                    @csrf
                    @if(!isset($request_name))
                        <?php $request_name = null; ?>
                    @endif
                    <div class="search-form__input">
                        <input class="search-form__input-text" type="text" name="name" placeholder="商品名で検索" />
                    </div>
                    <div class="search-form__button">
                        <button class="search-form__button-submit" type="submit">検索</button>
                    </div>
                </form>
            </div>
            <div class="sort">
                <p class="sort-heading">価格順で表示</p>
                <form class="sort-form" action="/products" method="post">
                    @csrf
                    <div class="sort-form__select">
                        <select class="sort-form__select-box" name="sort_type" onchange="this.form.submit()">
                            <option value="">価格で並べ替え</option>
                            <option value="desc">高い順に表示</option>
                            <option value="asc">低い順に表示</option>
                        </select>
                    </div>
                    <form class="sort-form__tag" action="/products" method="post">
                    @if(isset($sort_type))
                        <div class="sort-form__tag-area">
                            @if($sort_type=="desc")
                                <span>高い順に表示</span>
                            @elseif($sort_type=="asc")
                                <span>低い順に表示</span>
                            @endif
                            <input type="hidden" name="sort_type" value=null>
                            <button class="sort-form__tag-delete--button" type="submit">×</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
        <div class="products-list__display">
            <div class="products-list__display-items">
                @foreach($products as $product)
                <a class="product-card" href="{{ URL::to('/products/' . $product['id']) }}">
                    <div class="product-card__img">
                        <img src="{{ asset($product->image) }}" alt="" />
                    </div>
                    <div class="product-card__tag">
                        <span class="product-card__tag--name">{{ $product['name'] }}</span>
                        <span class="product-card__tag--price">{{ '¥' . $product['price'] }}</span>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="products-list__display-footer">
                @if (is_null($request_name))
                    {{ $products->links() }}
                @else
                    {{ $products->appends([
                        ' name' => $request_name,
                       ])->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection