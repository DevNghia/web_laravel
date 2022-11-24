@extends('welcome')

@section('sibar_left')
@include('pages.inc.sibar_left')
@endsection
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Danh Sách sản phẩm yêu thích</h2>
                                @php
                                  
								  $wishlist =Session()->get('wishlist');
                              @endphp
							@if ($wishlist)
								@foreach ($wishlist as $wish)
						
						<div class="col-sm-4">
						
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>
												{{ csrf_field() }}
												<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
												<input name="productid_hidden" type="hidden"  value="{{$product->product_id}}" />
											<a href="/show-detail/{{$product->product_id}}">
                                                
                                                    <img src="public/uploads/product/{{$wish['product_image']}}" alt="" />
											        <h2>{{number_format($wish['product_price']).' '.'VND'}}</h2>
											        <p>{{$wish['product_name']}}</p>
                                               
											
											</a>
											<button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->product_id}}" name="add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</button>
											</form>
										</div>
										
								</div>
							
							</div>
							
						</div>
						
						@endforeach
							@else
								<span style="color: red; font-size:20px">Bạn chưa có sản phẩm yêu thích nào</span>
							@endif
							
                        
						

						
						
					</div><!--features_items-->
                    
					
				
@endsection