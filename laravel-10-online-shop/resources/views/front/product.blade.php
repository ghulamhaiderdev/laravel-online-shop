@extends('front.layouts.app')
@section('content')

    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('front.home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('shop.home') }}">Shop</a></li>
                    <li class="breadcrumb-item">{{ $product->title }}</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-7 pt-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-5">
                    <div id="product-carousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-light">
                            @if($product->product_images->isNotEmpty())
                                @foreach($product->product_images as $key => $productImage)
                                    <div class="carousel-item {{ ($key == 0) ? 'active' : '' }}">
                                        <img class="w-100 h-100" src="{{ asset('uploads/product/large/'.$productImage->image) }}" alt="Image">
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <a class="carousel-control-prev" href="#product-carousel" data-bs-slide="prev">
                            <i class="fa fa-2x fa-angle-left text-dark"></i>
                        </a>
                        <a class="carousel-control-next" href="#product-carousel" data-bs-slide="next">
                            <i class="fa fa-2x fa-angle-right text-dark"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="bg-light right">
                        <h1>{{ $product->title }}</h1>
                        <div class="d-flex mb-3">
                            <div class="text-primary mr-2">
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star"></small>
                                <small class="fas fa-star-half-alt"></small>
                                <small class="far fa-star"></small>
                            </div>
                            <small class="pt-1">(99 Reviews)</small>
                        </div>
                        @if($product->price > 0)
                        <h2 class="price text-secondary"><del>{{ $product->compare_price }}</del></h2>
                        @endif
                        <h2 class="price ">{{ $product->price }}</h2>

                        <p>
                            {!!  $product->short_description !!}
                        </p>
                        <a href="javascript:void(0)" onclick="addToCart({{ $product->id }})" class="btn btn-dark"><i class="fas fa-shopping-cart"></i> &nbsp;ADD TO CART</a>
                    </div>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="bg-light">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Description</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shipping-tab" data-bs-toggle="tab" data-bs-target="#shipping" type="button" role="tab" aria-controls="shipping" aria-selected="false">Shipping & Returns</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab" aria-controls="reviews" aria-selected="false">Reviews</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                                <p>
                                   {!!  $product->description !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                <p>
                                    {!!  $product->shipping_returns !!}
                                </p>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <link rel="stylesheet" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css" integrity="sha384-jbCTJB16Q17718YM9U22iJkhuGbS0Gd2LjaWb4YJEZToOPmnKDjySVa323U+W7Fv" crossorigin="anonymous">
                                <div class="container">
                                    <div class="col-md-12">
                                        <div class="offer-dedicated-body-left">
                                            <div class="tab-content" id="pills-tabContent">
                                                <div class="tab-pane fade" id="pills-order-online" role="tabpanel" aria-labelledby="pills-order-online-tab">
                                                    <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">
                                                        <h5 class="mb-4">Recommended</h5>
                                                        <form class="explore-outlets-search mb-4">
                                                            <div class="input-group">
                                                                <input type="text" placeholder="Search for dishes..." class="form-control">
                                                                <div class="input-group-append">
                                                                    <button type="button" class="btn btn-link">
                                                                        <i class="icofont-search"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <h6 class="mb-3">Most Popular  <span class="badge badge-success"><i class="icofont-tags"></i> 15% Off All Items </span></h6>
                                                        <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel mb-3 owl-loaded owl-drag owl-hidden">

                                                            <div class="owl-stage-outer">
                                                                <div class="owl-stage" style="transform: translate3d(-682px, 0px, 0px); transition: all 0s ease 0s; width: 2183px;">
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/2.png">
                                                                                    <h6>Sandwiches</h6>
                                                                                    <small>8 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/3.png">
                                                                                    <h6>Soups</h6>
                                                                                    <small>2 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/4.png">
                                                                                    <h6>Pizzas</h6>
                                                                                    <small>56 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/5.png">
                                                                                    <h6>Pastas</h6>
                                                                                    <small>10 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/6.png">
                                                                                    <h6>Chinese</h6>
                                                                                    <small>25 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item active" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/1.png">
                                                                                    <h6>Burgers</h6>
                                                                                    <small>5 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item active" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/2.png">
                                                                                    <h6>Sandwiches</h6>
                                                                                    <small>8 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item active" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/3.png">
                                                                                    <h6>Soups</h6>
                                                                                    <small>2 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item active" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/4.png">
                                                                                    <h6>Pizzas</h6>
                                                                                    <small>56 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item active" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/5.png">
                                                                                    <h6>Pastas</h6>
                                                                                    <small>10 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/6.png">
                                                                                    <h6>Chinese</h6>
                                                                                    <small>25 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/1.png">
                                                                                    <h6>Burgers</h6>
                                                                                    <small>5 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/2.png">
                                                                                    <h6>Sandwiches</h6>
                                                                                    <small>8 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/3.png">
                                                                                    <h6>Soups</h6>
                                                                                    <small>2 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/4.png">
                                                                                    <h6>Pizzas</h6>
                                                                                    <small>56 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="owl-item cloned" style="width: 136.4px;">
                                                                        <div class="item">
                                                                            <div class="mall-category-item">
                                                                                <a href="#">
                                                                                    <img class="img-fluid" src="img/list/5.png">
                                                                                    <h6>Pastas</h6>
                                                                                    <small>10 ITEMS</small>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="owl-nav">
                                                                <button type="button" role="presentation" class="owl-prev"><i class="icofont-thin-left"></i></button>
                                                                <button type="button" role="presentation" class="owl-next"><i class="icofont-thin-right"></i></button>
                                                            </div>
                                                            <div class="owl-dots disabled"></div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 class="mb-4 mt-3 col-md-12">Best Sellers</h5>
                                                        <div class="col-md-4 col-sm-6 mb-4">
                                                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                                <div class="list-card-image">
                                                                    <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                                                    <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                                                    <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                                                    <a href="#">
                                                                        <img src="img/list/7.png" class="img-fluid item-img">
                                                                    </a>
                                                                </div>
                                                                <div class="p-3 position-relative">
                                                                    <div class="list-card-body">
                                                                        <h6 class="mb-1"><a href="#" class="text-black">Bite Me Sandwiches</a></h6>
                                                                        <p class="text-gray mb-2">North Indian • Indian</p>
                                                                        <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$550 </a> <span class="badge badge-success">NEW</span> <span class="float-right">
                                             <a class="btn btn-outline-secondary btn-sm" href="#">ADD</a>
                                             </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 mb-4">
                                                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                                <div class="list-card-image">
                                                                    <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                                                    <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                                                    <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                                                    <a href="#">
                                                                        <img src="img/list/8.png" class="img-fluid item-img">
                                                                    </a>
                                                                </div>
                                                                <div class="p-3 position-relative">
                                                                    <div class="list-card-body">
                                                                        <h6 class="mb-1"><a href="#" class="text-black">Famous Dave's Bar-B
                                                                            </a>
                                                                        </h6>
                                                                        <p class="text-gray mb-2">Hamburgers • Indian</p>
                                                                        <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$250 </a> <span class="badge badge-primary">NEW</span> <span class="float-right">
                                             <span class="count-number">
                                             <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                             <input class="count-number-input" type="text" value="1" readonly="">
                                             <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                             </span>
                                        </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 mb-4">
                                                            <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                                <div class="list-card-image">
                                                                    <div class="star position-absolute"><span class="badge badge-success"><i class="icofont-star"></i> 3.1 (300+)</span></div>
                                                                    <div class="favourite-heart text-danger position-absolute"><a href="#"><i class="icofont-heart"></i></a></div>
                                                                    <div class="member-plan position-absolute"><span class="badge badge-dark">Promoted</span></div>
                                                                    <a href="#">
                                                                        <img src="img/list/9.png" class="img-fluid item-img">
                                                                    </a>
                                                                </div>
                                                                <div class="p-3 position-relative">
                                                                    <div class="list-card-body">
                                                                        <h6 class="mb-1"><a href="#" class="text-black">Bite Me Sandwiches</a></h6>
                                                                        <p class="text-gray mb-2">North Indian • Indian</p>
                                                                        <p class="text-gray time mb-0"><a class="btn btn-link btn-sm pl-0 text-black pr-0" href="#">$250 </a> <span class="badge badge-info">NEW</span> <span class="float-right">
                                             <a class="btn btn-outline-secondary btn-sm" href="#">ADD</a>
                                             </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 class="mb-4 mt-3 col-md-12">Quick Bites <small class="h6 text-black-50">3 ITEMS</small></h5>
                                                        <div class="col-md-12">
                                                            <div class="bg-white rounded border shadow-sm mb-4">
                                                                <div class="gold-members p-3 border-bottom">
                                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Chicken Tikka Sub</h6>
                                                                            <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Cheese corn Roll <span class="badge badge-danger">BESTSELLER</span></h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Cheese Spinach corn Roll <span class="badge badge-success">Pure Veg</span></h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 class="mb-4 mt-3 col-md-12">Starters <small class="h6 text-black-50">3 ITEMS</small></h5>
                                                        <div class="col-md-12">
                                                            <div class="bg-white rounded border shadow-sm mb-4">
                                                                <div class="menu-list p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                                                    <div class="media">
                                                                        <img class="mr-3 rounded-pill" src="img/5.jpg" alt="Generic placeholder image">
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Veg Spring Roll</h6>
                                                                            <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="menu-list p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                                                    <div class="media">
                                                                        <img class="mr-3 rounded-pill" src="img/2.jpg" alt="Generic placeholder image">
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Stuffed Mushroom <span class="badge badge-danger">BESTSELLER</span></h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="menu-list p-3">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                                                    <div class="media">
                                                                        <img class="mr-3 rounded-pill" src="img/3.jpg" alt="Generic placeholder image">
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Honey Chilli Potato
                                                                                <span class="badge badge-success">Pure Veg</span>
                                                                            </h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <h5 class="mb-4 mt-3 col-md-12">Soups <small class="h6 text-black-50">8 ITEMS</small></h5>
                                                        <div class="col-md-12">
                                                            <div class="bg-white rounded border shadow-sm">
                                                                <div class="gold-members p-3 border-bottom">
                                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Tomato Dhania Shorba</h6>
                                                                            <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3 border-bottom">
                                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Veg Manchow Soup</h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3 border-bottom">
                                <span class="count-number float-right">
                                       <button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>
                                       <input class="count-number-input" type="text" value="1" readonly="">
                                       <button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>
                                       </span>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Lemon Coriander Soup</h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3 border-bottom">
                                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Tomato Dhania Shorba</h6>
                                                                            <p class="text-gray mb-0">$314 - 12" (30 cm)</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3 border-bottom">
                                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-danger food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Veg Manchow Soup</h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gold-members p-3">
                                                                    <a class="btn btn-outline-secondary btn-sm  float-right" href="#">ADD</a>
                                                                    <div class="media">
                                                                        <div class="mr-3"><i class="icofont-ui-press text-success food-item"></i></div>
                                                                        <div class="media-body">
                                                                            <h6 class="mb-1">Lemon Coriander Soup</h6>
                                                                            <p class="text-gray mb-0">$600</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab">
                                                    <div id="gallery" class="bg-white rounded shadow-sm p-4 mb-4">
                                                        <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                                                            <div class="owl-carousel owl-theme homepage-ad owl-loaded owl-drag owl-hidden">

                                                                <div class="owl-stage-outer">
                                                                    <div class="owl-stage" style="transform: translate3d(-1364px, 0px, 0px); transition: all 0s ease 0s; width: 8184px;">
                                                                        <div class="owl-item cloned" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/1.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item cloned" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/2.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item cloned" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/3.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item active" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/1.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/2.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/3.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/1.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/2.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/3.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item cloned" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/1.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item cloned" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/2.png">
                                                                            </div>
                                                                        </div>
                                                                        <div class="owl-item cloned" style="width: 682px;">
                                                                            <div class="item">
                                                                                <img class="img-fluid" src="img/gallery/3.png">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="owl-nav">
                                                                    <button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left"></i></button>
                                                                    <button type="button" role="presentation" class="owl-next"><i class="fa fa-chevron-right"></i></button>
                                                                </div>
                                                                <div class="owl-dots disabled"></div>
                                                            </div>
                                                            <div class="position-absolute restaurant-slider-pics bg-dark text-white">2 of 14 Photos</div>
                                                            <div class="position-absolute restaurant-slider-view-all">
                                                                <button type="button" class="btn btn-light bg-white">See all Photos</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel" aria-labelledby="pills-restaurant-info-tab">
                                                    <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                                                        <div class="address-map float-right ml-5">
                                                            <div class="mapouter">
                                                                <div class="gmap_canvas">
                                                                    <iframe width="300" height="170" id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <h5 class="mb-4">Restaurant Info</h5>
                                                        <p class="mb-3">Jagjit Nagar, Near Railway Crossing,
                                                            <br> Near Model Town, Ludhiana, PUNJAB
                                                        </p>
                                                        <p class="mb-2 text-black"><i class="icofont-phone-circle text-primary mr-2"></i> +91 01234-56789, +91 01234-56789</p>
                                                        <p class="mb-2 text-black"><i class="icofont-email text-primary mr-2"></i> iamosahan@gmail.com, osahaneat@gmail.com</p>
                                                        <p class="mb-2 text-black"><i class="icofont-clock-time text-primary mr-2"></i> Today 11am – 5pm, 6pm – 11pm
                                                            <span class="badge badge-success"> OPEN NOW </span>
                                                        </p>
                                                        <hr class="clearfix">
                                                        <p class="text-black mb-0">You can also check the 3D view by using our menue map clicking here &nbsp;&nbsp;&nbsp; <a class="text-info font-weight-bold" href="#">Venue Map</a></p>
                                                        <hr class="clearfix">
                                                        <h5 class="mt-4 mb-4">More Info</h5>
                                                        <p class="mb-3">Dal Makhani, Panneer Butter Masala, Kadhai Paneer, Raita, Veg Thali, Laccha Paratha, Butter Naan</p>
                                                        <div class="border-btn-main mb-4">
                                                            <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                                            <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                                            <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                                            <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Indoor Seating</a>
                                                            <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Breakfast</a>
                                                            <a class="border-btn text-danger mr-2" href="#"><i class="icofont-close-circled"></i> No Alcohol Available</a>
                                                            <a class="border-btn text-success mr-2" href="#"><i class="icofont-check-circled"></i> Vegetarian Only</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-book" role="tabpanel" aria-labelledby="pills-book-tab">
                                                    <div id="book-a-table" class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                                                        <h5 class="mb-4">Book A Table</h5>
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Full Name</label>
                                                                        <input class="form-control" type="text" placeholder="Enter Full Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Email Address</label>
                                                                        <input class="form-control" type="text" placeholder="Enter Email address">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Mobile number</label>
                                                                        <input class="form-control" type="text" placeholder="Enter Mobile number">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group">
                                                                        <label>Date And Time</label>
                                                                        <input class="form-control" type="text" placeholder="Enter Date And Time">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group text-right">
                                                                <button class="btn btn-primary" type="button"> Submit </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade active show" id="pills-reviews" role="tabpanel" aria-labelledby="pills-reviews-tab">

                                                    <div class="bg-white rounded shadow-sm p-4 mb-4 restaurant-detailed-ratings-and-reviews">
                                                        <h5 class="mb-1">All Reviews</h5>
                                                        <div class="reviews-members pt-4 pb-4">
                                                            <div class="media">
                                                                <a href="#"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar1.png" class="mr-3 rounded-pill"></a>
                                                                <div class="media-body">
                                                                    <div class="reviews-members-header">
                                                                    <span class="star-rating float-right">
                                                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                                                          <a href="#"><i class="icofont-ui-rating"></i></a>
                                                                          </span>
                                                                        <h6 class="mb-1"><a class="text-black" href="#">Singh Osahan</a></h6>
                                                                        <p class="text-gray">Tue, 20 Mar 2020</p>
                                                                    </div>
                                                                    <div class="reviews-members-body">
                                                                        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections </p>
                                                                    </div>
                                                                    <div class="reviews-members-footer">
                                                                        <a class="total-like" href="#"><i class="icofont-thumbs-up"></i> 856M</a> <a class="total-like" href="#"><i class="icofont-thumbs-down"></i> 158K</a>
                                                                        <span class="total-like-user-main ml-2" dir="rtl">
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Gurdeep Osahan"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar5.png" class="total-like-user rounded-pill"></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Gurdeep Singh"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar2.png" class="total-like-user rounded-pill"></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Askbootstrap"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar3.png" class="total-like-user rounded-pill"></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Osahan"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar4.png" class="total-like-user rounded-pill"></a>
                                          </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="reviews-members pt-4 pb-4">
                                                            <div class="media">
                                                                <a href="#"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar6.png" class="mr-3 rounded-pill"></a>
                                                                <div class="media-body">
                                                                    <div class="reviews-members-header">
                                    <span class="star-rating float-right">
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating active"></i></a>
                                          <a href="#"><i class="icofont-ui-rating"></i></a>
                                          </span>
                                                                        <h6 class="mb-1"><a class="text-black" href="#">Gurdeep Singh</a></h6>
                                                                        <p class="text-gray">Tue, 20 Mar 2020</p>
                                                                    </div>
                                                                    <div class="reviews-members-body">
                                                                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>
                                                                    </div>
                                                                    <div class="reviews-members-footer">
                                                                        <a class="total-like" href="#"><i class="icofont-thumbs-up"></i> 88K</a> <a class="total-like" href="#"><i class="icofont-thumbs-down"></i> 1K</a>
                                                                        <span class="total-like-user-main ml-2" dir="rtl">
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Gurdeep Osahan"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar5.png" class="total-like-user rounded-pill"></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Gurdeep Singh"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar2.png" class="total-like-user rounded-pill"></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Askbootstrap"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar3.png" class="total-like-user rounded-pill"></a>
                                          <a data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Osahan"><img alt="Generic placeholder image" src="http://bootdey.com/img/Content/avatar/avatar4.png" class="total-like-user rounded-pill"></a>
                                          </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <a class="text-center w-100 d-block mt-4 font-weight-bold" href="#">See All Reviews</a>
                                                    </div>
                                                    <div class="bg-white rounded shadow-sm p-4 mb-5 rating-review-select-page">
                                                        <h5 class="mb-4">Leave Comment</h5>
                                                        <div class="mb-4">
                                                    <span class="star-rating">
                                                             <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                                             <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                                             <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                                             <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                                             <a href="#"><i class="icofont-ui-rating icofont-2x"></i></a>
                                                             </span>
                                                        </div>
                                                        <form>
                                                            <div class="form-group">
                                                                <label>Your Comment</label>
                                                                <textarea class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-primary btn-sm" type="button"> Submit Comment </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-5 section-8">
        <div class="container">
            <div class="section-title">
                <h2>Related Products</h2>
            </div>
            <div class="col-md-12">
                <div id="related-products" class="carousel">
                    @if(!empty($relatedProducts))
                        @foreach($relatedProducts as $relProduct)

                            <div class="card product-card">
                        <div class="product-image position-relative">
                            <a href="" class="product-img">
                                @if(!empty($relProduct->image))
                                    <img src="{{ asset('uploads/product/small/'.$relProduct->image) }}" class="card-img-top" >
                                @else
                                    <img src="{{ asset('admin-assets/img/default-150x150.png') }}" class="img-thumbnail" width="50" >
                                @endif
                            </a>
                            <a class="whishlist" href="{{ route('front.cart', $relProduct->slug) }}"><i class="far fa-heart"></i></a>

                            <div class="product-action">
                                @if($relProduct->track_qty == 'Yes')
                                    @if($relProduct->qty)

                                        <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $relProduct->id }})">
                                            <i class="fa fa-shopping-cart"></i> Add To Cart
                                        </a>

                                    @else
                                        <a class="btn btn-dark" href="javascript:void(0)">
                                            Out Of Stock
                                        </a>
                                    @endif

                                @else
                                    <a class="btn btn-dark" href="javascript:void(0)"  onclick="addToCart({{ $relProduct->id }})">
                                        <i class="fa fa-shopping-cart"></i> Add To Cart
                                    </a>
                                @endif
                            </div>
                        </div>
                        <div class="card-body text-center mt-3">
                            <a class="h6 link" href="">{{ $relProduct->title }}</a>
                            <div class="price mt-2">
                                <span class="h5"><strong>{{ $relProduct->price }}</strong></span>
                                @if($relProduct->compare_price > 0)
                                <span class="h6 text-underline"><del>{{ $relProduct->compare_price }}</del></span>
                                @endif
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customJs')
@endsection
