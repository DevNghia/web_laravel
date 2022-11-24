@extends('welcome')
@section('slide')
@include('pages.inc.slide')
@endsection
@section('sibar_left')
@include('pages.inc.sibar_left')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm nổi bật</h2>
							@foreach ($product as $key=>$pro)
						
						<div class="col-sm-4">
							<form>
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											
												{{ csrf_field() }}
												<input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
												<input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
												<input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
												<input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
												<input name="productid_hidden" type="hidden"  value="{{$pro->product_id}}" />
											<a href="/show-detail/{{$pro->product_id}}">
											<img src="public/uploads/product/{{$pro->product_image}}" alt="" />
											<h2>{{number_format($pro->product_price).' '.'VND'}}</h2>
											<p>{{$pro->product_name}}</p>
											</a>
											<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$pro->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
											
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><button type="button" class="btn btn-default add-to-wishlist" data-id_product="{{$pro->product_id}}" name="add-to-wishlist"><i class="fa fa-plus-square"></i>Yêu thích</button></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
							</form>
						</div>
						
						@endforeach
						
			
						
						
					</div><!--features_items-->
					
				
					
					{{-- <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="public/frontend/images/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="public/frontend/images/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="public/frontend/images/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
								<div class="item">	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="public/frontend/images/recommend1.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="public/frontend/images/recommend2.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="public/frontend/images/recommend3.jpg" alt="" />
													<h2>$56</h2>
													<p>Easy Polo Black Edition</p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items--> --}}
@endsection