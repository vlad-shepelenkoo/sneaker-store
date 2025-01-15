@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Wishlist</h2>
      <div class="row">
        <div class="col-lg-3">
          @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__wishlist">
            <div class="products-grid row row-cols-2 row-cols-lg-3" id="products-grid">
                @if (Cart::instance('wishlist')->content()->count() > 0)
                    @foreach ($items as $item)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                            <div class="pc__img-wrapper">
                                <div class="swiper-container background-img js-swiper-slider"
                                data-settings='{"resizeObserver": true}'>
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <a href="{{route('shop.product.details', ['product_slug' => $item->product->slug])}}"><img loading="lazy" src="{{asset('uploads/products')}}/{{$item->product->image}}" width="330" height="400" alt="{{$item->product->name}}" class="pc__img"></a>
                                    </div>
                                    @foreach (explode(',',$item->product->images) as $gimg)
                                    <div class="swiper-slide">
                                        <a href="{{route('shop.product.details', ['product_slug'=>$item->product->slug])}}"> <img loading="lazy" src="{{asset('uploads/products')}}/{{$gimg}}" width="330" height="400" alt="{{$item->product->name}}" class="pc__img"></a>
                                    </div>
                                    @endforeach
                                </div>
                                <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_sm" />
                                    </svg></span>
                                <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_next_sm" />
                                    </svg></span>
                                </div>
                                <form method="POST" action="{{route('wishlist.items.remove', ['rowId'=>$item->rowId])}}" id="remove-item-{{$item->product->id}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-remove-from-wishlist" onclick="document.getElementById('remove-item-{{$item->product->id}}').submit();">
                                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_close" />
                                    </svg>
                                    </button>
                                </form>
                            </div>

                            <div class="pc__info position-relative">
                                <p class="pc__category">{{$item->product->category->name}}</p>
                                <h6 class="pc__title">{{$item->product->name}}</h6>
                                <div class="product-card__price d-flex">
                                <span class="money price">${{$item->product->sale_price == '' ? $item->product->regular_price : $item->product->sale_price}}</span>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <p>No item found in your wishlist</p>
                            <a href="{{route('shop.index')}}" class="btn btn-info">Shop Now</a>
                        </div>
                    </div>
                @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection