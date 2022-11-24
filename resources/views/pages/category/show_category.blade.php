@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
	<div class="fb-share-button" data-href="http://localhost:3000/" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
	
					@foreach ($category_name as $key=>$name)
						<h2 class="title text-center">{{$name->category_name}}</h2>
					@endforeach
						
							@foreach ($category_by_id as $key=>$cate_pro)
						<a href="/show-detail/{{$cate_pro->product_id}}">
						<div class="col-sm-4">
						
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="/public/uploads/product/{{$cate_pro->product_image}}" alt="" />
											<h2>{{number_format($cate_pro->product_price).' '.'VND'}}</h2>
											<p>{{$cate_pro->product_name}}</p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
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
						</a>
						
						@endforeach
						
						
						
						
					
@endsection