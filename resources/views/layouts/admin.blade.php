<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('font/fonts.css')}}">
    <link rel="stylesheet" href="{{ asset('icon/style.css')}}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/favicon.ico')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css')}}">
    @stack('styles')
</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">
                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{route('admin.index')}}" id="site-logo-inner">
                            <img class="" id="logo_header" alt="" src="{{ asset('assets/images/logo.png') }}"
                                data-light="{{ asset('assets/images/logo.png') }}" data-dark="{{ asset('assets/images/logo.png') }}" style="height: 65px">
                        </a>
                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="{{route('admin.index')}}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="center-item">
                            <ul class="menu-list">
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-shopping-cart"></i></div>
                                        <div class="text">Products</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.product.add')}}" class="">
                                                <div class="text">Add Product</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.products')}}" class="">
                                                <div class="text">Products</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Brand</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.brand.add')}}" class="">
                                                <div class="text">New Brand</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.brands')}}" class="">
                                                <div class="text">Brands</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Category</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.category.add')}}" class="">
                                                <div class="text">New Category</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.categories')}}" class="">
                                                <div class="text">Categories</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Order</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{route('admin.orders')}}" class="">
                                                <div class="text">Orders</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item">
                                    <a href="{{route('admin.slides')}}" class="">
                                        <div class="icon"><i class="icon-image"></i></div>
                                        <div class="text">Slides</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="{{route('admin.coupons')}}" class="">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Coupons</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="{{route('admin.contacts')}}" class="">
                                        <div class="icon"><i class="icon-mail"></i></div>
                                        <div class="text">Messages</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <a href="{{route('admin.users')}}" class="">
                                        <div class="icon"><i class="icon-user"></i></div>
                                        <div class="text">Users</div>
                                    </a>
                                </li>

                                <li class="menu-item">  
                                    <a href="{{route('admin.settings')}}" class="settingsroute">
                                        <div class="icon"><i class="icon-settings"></i></div>
                                        <div class="text">Settings</div>
                                    </a>
                                </li>

                                <li class="menu-item">
                                    <form method="POST" action="{{route('logout')}}" id="logout-form">
                                    @csrf
                                        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <div class="icon"><i class="icon-log-out"></i></div>
                                        <div class="text">Logout</div>
                                    </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="section-content-right">

                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="index-2.html">
                                    <img class="" id="logo_header_mobile" alt="" src="{{ asset('assets/images/logo.png') }}"
                                        data-light="{{ asset('assets/images/logo.png') }}" data-dark="{{ asset('assets/images/logo.png') }}"
                                        data-width="154px" data-height="52px" data-retina="{{ asset('assets/images/logo.png') }}">
                                </a>
                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>


                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search" name="name" id="search-input" tabindex="2" value="" aria-required="true" required="" autocomplete="off">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search">
                                        <ul id="box-content-search">

                                        </ul>
                                    </div>
                                </form>

                            </div>
                            <div class="header-grid">
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="{{asset('uploads/users')}}/{{Session::get('user')->image}}" alt="">
                                                </span>
                                                <span class="flex flex-column">
                                                    @if(Session::has('user'))
                                                        <span class="body-title mb-2">{{Session::get('user')->name}}</span>
                                                        @if(Session::get('user')->utype == 'ADM')
                                                            <span class="text-tiny">Admin</span>
                                                        @else
                                                            <span class="text-tiny">User</span>
                                                        @endif
                                                    @else
                                                        <span class="body-title mb-2">Name</span>
                                                        <span class="text-tiny">Role</span>
                                                    @endif
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="{{route('admin.settings')}}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('admin.contacts')}}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Inbox</div>
                                                    <div class="number">{{$newMessage}}</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('admin.index')}}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Taskboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('user.index')}}" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-bar-chart"></i>
                                                    </div>
                                                    <div class="body-title-2">User Dashboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{route('logout')}}" id="logout-form-bar">
                                                    @csrf
                                                    <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form-bar').submit();" class="user-item">
                                                        <div class="icon"><i class="icon-log-out"></i></div>
                                                        <div class="body-title-2">Log out</div>
                                                    </a>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="main-content">
                        @yield('content')

                        <div class="bottom-page">
                            <div class="body-text">Copyright © 2024 Vlad Shepelenko</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js')}}"></script>   
    <script src="{{ asset('js/sweetalert.min.js')}}"></script>    
    <script src="{{ asset('js/apexcharts/apexcharts.js')}}"></script>
    <script src="{{ asset('js/main.js')}}"></script>
    <script> 
        $(function(){
            $('#search-input').on('keyup', function(){
                var searchQuery = $(this).val();
                if(searchQuery.length > 2){
                    $.ajax({
                        type: 'GET',
                        url: "{{route('admin.search')}}",
                        data: {query: searchQuery},
                        dataType: 'json',
                        success: function(data){
                            $('#box-content-search').html('');
                            $.each(data, function(index, item){
                                var url = "{{route('admin.product.edit',['id'=>'product_id'])}}";
                                var link = url.replace('product_id', item.id);

                                $('#box-content-search').append(`
                                    <li>
                                        <ul>
                                            <li class="product-item gap14 mb-10">
                                                <div class="image no-bg">
                                                    <img src="{{asset('uploads/products/thumbnails')}}/${item.image}" alt="${item.name}">    
                                                </div>

                                                <div class="flex items-center justify-between gap20 flex-grow">
                                                    <div class="name">
                                                        <a href="${link}" class="body-text">${item.name}</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-10">
                                                <div class="divider"></div>
                                            </li>    
                                        </ul>
                                    </li>
                                `);
                            });
                        }
                    });
                }
            })
        })
    </script>
    @stack('scripts')
</body>
</html>
