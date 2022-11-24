@extends('welcome')

@section('sibar_left')
@include('pages.inc.sibar_left')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Tất cả sản phẩm</h2>
							@foreach ($product as $key=>$pro)
						
						<div class="col-sm-4">
						
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
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
											</form>
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
							
						</div>
						
						@endforeach
                        
						

						
						
					</div><!--features_items-->
                    <span>{{$product->links()}}</span>
					
				
@endsection