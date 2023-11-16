@extends('layouts.client')
@section('title')
    <title>Home</title>
@endsection
@section('css')
    <link href="/clients/home/main.css" rel="stylesheet">
@endsection
@section('js')
    <script src="/clients/home/main.js"></script>
@endsection
@section('content')

<section>
    <div class="container">
        <div class="row">
            @include('components.sidebar_client')
            
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    @foreach ($product as $item)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ $item->feature_image }}" alt="" />
                                            <h2>{{ number_format($item->price) }} VND</h2>
                                            <p>{{ $item->name }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{ number_format($item->price) }} VND</h2>
                                                <p>{{ $item->name }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!--features_items-->
                
                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            @foreach ($category as $key => $item)
                                <li class="{{ $key === 0 ? 'active' : '' }}"><a href="#{{ $item->id }}" data-toggle="tab">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content">
                        @foreach ($category as $keyCategory => $itemCategory)
                        <div class="tab-pane fade {{ $keyCategory == 0 ? 'active in' : '' }}" id="{{ $itemCategory->id }}" >
                            @foreach ($itemCategory->products as $productItem)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img src="/Eshopper/images/home/gallery1.jpg" alt="" />
                                                <h2>{{ number_format($productItem->price) }}</h2>
                                                <p>{{ $productItem->name }}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div><!--/category-tab-->
                
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>
                    
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($productRecommend as $key => $item)
                                @if($key % 3 === 0)
                                    <div class="item {{ $key === 0 ? 'active' : '' }}">
                                @endif
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ $item->feature_image }}" alt="" />
                                                    <h2>{{ number_format($item->price) }}</h2>
                                                    <p>{{ $item->name }}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @if($key % 2 === 0)
                                    </div>
                                @endif
                            @endforeach
                            
                        </div>
                         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                          </a>
                          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                          </a>			
                    </div>
                </div><!--/recommended_items-->
                
            </div>
        </div>
    </div>
</section>

@endsection