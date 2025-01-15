@extends('layouts.app')
@section('content')
<style>
  .filled-heart{
    color:orange;
  }

  .sizeDiv, .hideAddDiv{
    display: none;
  }

  .showAddDiv{
    display: block;
  }
  </style>
<main class="pt-90">
    <div class="mb-md-1 pb-md-3"></div>
    <section class="product-single container">
      <div class="row">
        <div class="col-lg-7">
          <div class="product-single__media" data-media-type="vertical-thumbnail">
            <div class="product-single__image">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-single__image-item">
                    <img loading="lazy" class="h-auto" src="{{asset('uploads/products')}}/{{$product->image}}" width="674" height="674" alt="" />
                    <a data-fancybox="gallery" href="{{asset('uploads/products')}}/{{$product->image}}" data-bs-toggle="tooltip"
                      data-bs-placement="left" title="Zoom">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_zoom" />
                      </svg>
                    </a>
                  </div>
                  @foreach (explode(',',$product->images) as $gimg)
                  <div class="swiper-slide product-single__image-item">
                    <img loading="lazy" class="h-auto" src="{{asset('uploads/products')}}/{{$gimg}}" width="674"
                      height="674" alt="" />
                    <a data-fancybox="gallery" href="{{asset('uploads/products')}}/{{$gimg}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_zoom" />
                      </svg>
                    </a>
                  </div>
                  @endforeach
                </div>
                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_prev_sm" />
                  </svg></div>
                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                    xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_next_sm" />
                  </svg></div>
              </div>
            </div>
            <div class="product-single__thumbnail">
              <div class="swiper-container">
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-single__image-item"><img loading="lazy" class="h-auto" src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}" width="104" height="104" alt="" /></div>
                  @foreach (explode(',',$product->images) as $gimg)
                    <div class="swiper-slide product-single__image-item"><img loading="lazy" class="h-auto" src="{{asset('uploads/products/thumbnails')}}/{{$gimg}}" width="104" height="104" alt="" /></div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="d-flex justify-content-between mb-4 pb-md-2">
            <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
              <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
              <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
              <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
            </div>
          </div>
          <h1 class="product-single__name">{{$product->brand->name}}</h1>
          <h1 class="product-single__name">{{$product->name}}</h1>
          <div class="product-single__rating">
            <div class="reviews-group d-flex">
              @for ($avg = 0; $avg < $reviewsAvg; $avg++)
                <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_star" />
                </svg>
              @endfor
            </div>
            <span class="reviews-note text-lowercase text-secondary ms-1">{{$reviewsCount}} reviews</span>
          </div>
          <div class="product-single__price">
            <span class="current-price">
              @if ($product->sale_price)
                <s>${{$product->regular_price}}</s> ${{$product->sale_price}}
              @else
                  ${{$product->regular_price}}
              @endif
            </span>
          </div>
          <div class="product-single__short-desc">
            <p>{{$product->short_description}}</p>
          </div>
          @if($sizes->count() == 0)
            <a href="{{route('cart.index')}}" class="btn btn-warning mb-3">Go to Cart</a>
          @else
            <div class="accordion" id="size-filters">
              <div class="accordion-item mb-4 pb-3">
                <h5 class="accordion-header" id="accordion-heading-size">
                  <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"
                    data-bs-target="#accordion-filter-size" aria-expanded="true" aria-controls="accordion-filter-size">
                    Sizes
                  </button>
                </h5>
                <div id="accordion-filter-size" class="accordion-collapse collapse show border-0"
                      aria-labelledby="accordion-heading-size" data-bs-parent="#size-filters">
                  <div class="accordion-body px-0 pb-0">
                    <div class="d-flex flex-wrap">
                      @foreach ($sizes as $size)
                        @if ($size->product_id == $product->id)
                          <a href="javascript:void(0)" onclick="CreateAddSize('addtocart-form', {{$size->size}})" name="size" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">{{$size->size}}</a>
                        @endif
                      @endforeach
                    </div>
                  </div>
                </div>  
              </div>
            </div>
            <form id="addtocart-form" name="addtocart-form" method="post" action="{{route('cart.add')}}">
              @csrf
                <div class="product-single__addtocart">
                  <div class="qty-control position-relative">
                    <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                    <div class="qty-control__reduce">-</div>
                    <div class="qty-control__increase">+</div>
                  </div>
                  <input type="hidden" name="id" value="{{$product->id}}" />
                  <input type="hidden" name="name" value="{{$product->name}}" />
                  <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}" />
                  <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Add to
                    Cart</button>
                </div>
            </form>
          @endif
          <div class="product-single__addtolinks">
            @if(Cart::instance('wishlist')->content()->where('id',$product->id)->count() >0)
            <form method="POST" action="{{route('wishlist.items.remove', ["rowId"=>Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId])}}" id="frm-remove-item">
              @csrf
              @method('DELETE')  
              <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist filled-heart" onclick="document.getElementById('frm-remove-item').submit();"><svg width="16" height="16" viewBox="0 0 20 20"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <use href="#icon_heart" />
                  </svg><span>Remove from Wishlist</span></a>
            </form>
              @else
              <form method="POST">
                <button type="button" class="pc__btn-wl bg-transparent border-0 js-add-wishlist" data-bs-toggle="modal" data-bs-target="#modalSize">
                  <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <use href="#icon_heart" />
                </svg>
                <span>Add to Wishlist</span></button>
              </form>
              @endif
          </div>
          <div class="product-single__meta-info">
            <div class="meta-item">
              <label>SKU:</label>
              <span>{{$product->SKU}}</span>
            </div>
            <div class="meta-item">
              <label>Categories:</label>
              <span>{{$product->category->name}}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="product-single__details-tab">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
              href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Description</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab" href="#tab-reviews"
              role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews ({{$reviews->count()}})</a>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
            aria-labelledby="tab-description-tab">
            <div class="product-single__description">
              {{$product->description}}
            </div>
          </div>  
          <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
            <h2 class="product-single__reviews-title">Reviews</h2>
            <div class="product-single__reviews-list">
              @foreach ($reviews as $review)
              <div class="product-single__reviews-item">
                <div class="customer-avatar">
                  <img loading="lazy" src="{{asset('uploads/users')}}/{{$review->image}}" alt="" />
                </div>
                <div class="customer-review">
                  <div class="customer-name">
                    <h6>{{$review->name}}</h6>
                    <div class="reviews-group d-flex">
                      @for ($star = 0; $star < $review->rating; $star++)
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                          <use href="#icon_star" />
                        </svg>
                      @endfor
                    </div>
                  </div>
                  <div class="review-date">{{\Carbon\Carbon::parse($review->created_at)->format('F jS, Y')}}</div>
                  <div class="review-text">
                    <p>{{$review->review}}</p>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
            <div class="product-single__review-form">
              <form name="customer-review-form" action="{{route('user.review.add')}}" method="POST">
                @csrf
                <h5>Review the “{{$product->name}}”</h5>
                <div class="select-star-rating">
                  <label>Your rating *</label>
                  <span class="star-rating">
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                      xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                  </span>
                  <input type="hidden" name="product_id" value="{{$product->id}}" />
                  @if (Auth::user())
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}" />
                  @endif
                  <input type="hidden" name="rating" id="form-input-rating" value="" />
                </div>
                <div class="mb-4">
                  <textarea id="form-input-review" name="review" class="form-control form-control_gray" placeholder="Your Review"
                    cols="30" rows="8"></textarea>
                </div>
                <div class="form-action">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="products-carousel container">
      <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

      <div id="related_products" class="position-relative">
        <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
          <div class="swiper-wrapper">
            @foreach ($rproducts as $rproduct)
            <div class="swiper-slide product-card">
              <div class="pc__img-wrapper">
                <a href="{{route('shop.product.details', ['product_slug'=>$rproduct->slug])}}">
                  <img loading="lazy" src="{{asset('uploads/products')}}/{{$rproduct->image}}" width="330" height="400" alt="{{$rproduct->name}}" class="pc__img">
                  @foreach (explode(',',$rproduct->images) as $gimg)
                    <img loading="lazy" src="{{asset('uploads/products')}}/{{$gimg}}" width="330" height="400" alt="{{$rproduct->name}}" class="pc__img pc__img-second">
                  @endforeach
                </a>
                @if(Cart::instance('cart')->content()->where('id', $product->id)->count()>0)
                      <a href="{{route('cart.index')}}" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-warning mb-3">Go to Cart</a>
                    @else
                    <form name="addtocart-form" method="post" action="{{route('cart.add')}}">
                      @csrf
                      <button type="button" onclick="hideShowAddForm('{{$rproduct->slug}}')"
                        class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"
                        data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                    </form>
                 @endif
              </div>

              <div class="pc__info position-relative">
                <p class="pc__category">{{$rproduct->category->name}}</p>
                <h6 class="pc__title"><a href="{{route('shop.product.details', ['product_slug'=>$rproduct->slug])}}">{{$rproduct->brand->name}}</a></h6>
                <h6 class="pc__title"><a href="{{route('shop.product.details', ['product_slug'=>$rproduct->slug])}}">{{$rproduct->name}}</a></h6>
                <div class="product-card__price d-flex">
                  <span class="money price">
                    @if ($rproduct->sale_price)
                      <s>{{$rproduct->regular_price}}</s> ${{$rproduct->sale_price}}
                    @else
                      ${{$rproduct->regular_price}}
                    @endif
                  </span>
                </div>

                <div id="{{$rproduct->slug}}" class="hideAddDiv">
                  <h5>Choose size:</h5>
                  <form id="addtocart-form_{{$rproduct->id}}" name="addtocart-form" method="POST" action="{{route('cart.add')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$rproduct->id}}" />
                    <input type="hidden" name="quantity" value="1" />
                    <input type="hidden" name="name" value="{{$rproduct->name}}" />
                    <input type="hidden" name="price" value="{{$rproduct->sale_price == '' ? $rproduct->regular_price : $rproduct->sale_price}}" />
                    <div class="d-flex flex-wrap">
                      @foreach ($itemSizes as $size)
                        @if($size->product_id == $rproduct->id)
                          <a href="javascript:void(0)" onclick="CreateAddInput('addtocart-form_{{$rproduct->id}}', {{$size->size}}, '{{$rproduct->slug}}')" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">{{$size->size}}</a>
                        @endif
                      @endforeach
                    </div>
                  </form>
                </div>

                <div id="{{$rproduct->slug}}" class="sizeDiv"> 
                  <h5>Choose size: </h5>
                  <form id="wishlist-form-modal_{{$rproduct->id}}" method="POST" action="{{route('wishlist.add')}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$rproduct->id}}" />
                    <input type="hidden" name="name" value="{{$rproduct->name}}" />
                    <input type="hidden" name="price" value="{{$rproduct->sale_price == '' ? $rproduct->regular_price : $rproduct->sale_price}}" />
                    <input type="hidden" name="quantity" value="1" />
                    <div class="d-flex flex-wrap">
                      @foreach ($itemSizes as $size)
                        @if ($size->product_id == $rproduct->id)
                        <div id="{{$size->id}}">
                            <a href="javascript:void(0)" onclick="CreateSizeInput('wishlist-form-modal_{{$rproduct->id}}', {{$size->size}}, '{{$rproduct->slug}}');" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 js-filter">{{$size->size}}</a>
                        </div>
                            @endif
                      @endforeach
                    </div>
                  </form>
                </div>

                @if (Cart::instance('wishlist')->content()->where('id',$rproduct->id)->count() > 0)
                <form method="POST" action="{{route('wishlist.items.remove', ["rowId"=>Cart::instance('wishlist')->content()->where('id', $rproduct->id)->first()->rowId])}}">
                  @csrf
                  @method('DELETE')
                    <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist filled-heart"
                      title="Remove From Wishlist">
                      <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_heart" />
                      </svg>
                    </button>
                </form>
                @else
                <form method="POST">
                  <button type="button" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist" onclick="document.getElementById('{{$rproduct->slug}}').setAttribute('style', 'display:block');">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_heart" />
                    </svg>
                  </button>
                </form>
                @endif
              </div>
            </div>
            @endforeach
          </div>
        </div>

        <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
          <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_prev_md" />
          </svg>
        </div>
        <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
          <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
            <use href="#icon_next_md" />
          </svg>
        </div>

        <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
      </div>

    </section>
  </main>
@endsection
@push('scripts')
  <script>
    function CreateSizeInput(id, value, frmSizes){
      var form = document.getElementById(id);
      var sizeInput = document.createElement('input');
      sizeInput.id = 'sizeId';
      sizeInput.type = 'hidden';
      sizeInput.name = `size`;
      sizeInput.value = value;
      form.appendChild(sizeInput);
      frmSubmit(id);
      var frmSizes = document.getElementById(frmSizes);
      frmSizes.setAttribute('style', 'display:none');
    }

    function frmSubmit(id){
      var sizeId = document.getElementById('sizeId');
      if(sizeId != null){
        var frmSubmit = document.getElementById(id);
        frmSubmit.submit();
      }
    }

    function CreateAddSize(id, value){
      console.log('test');
      var form = document.getElementById(id);
      var sizes = document.querySelector(`#sizeId${value}`);
      console.log(sizes);
      if(sizes){
       form.removeChild(sizes);
      }
      else{
        var sizeInput = document.createElement('input');
        sizeInput.id = `sizeId${value}`;
        sizeInput.type = 'hidden';
        sizeInput.name = 'size[]';
        sizeInput.value = value;
        form.appendChild(sizeInput);
      }
    }

    function CreateAddInput(id, value, frmSizes){
      var form = document.getElementById(id);
      var sizeInput = document.createElement('input');
      sizeInput.id = 'sizeId';
      sizeInput.type = 'hidden';
      sizeInput.name = 'size[]';
      sizeInput.value = value;
      form.appendChild(sizeInput);
      frmSubmit(id);
      var frmSizes = document.getElementById(frmSizes);
      frmSizes.setAttribute('style', 'display:none');
    }

    function hideShowAddForm(name){
      var form = document.getElementById(name);
      if (form.getAttribute('class') == 'hideAddDiv'){
        form.classList.remove('hideAddDiv');
        form.classList.add('showAddDiv');  
      }
      else{
        form.classList.remove('showAddDiv');
        form.classList.add('hideAddDiv'); 
      };
    }
  </script>
@endpush