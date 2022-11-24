	<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach ($cate_product as $key=>$cate_pro)
								<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="/show-category/{{$cate_pro->category_id}}">{{$cate_pro->category_name}}</a></h4>
								</div>
							</div>
							@endforeach
							
							
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									@foreach ($brand_product as $key=>$brand_pro)
										<li><a href="/show-brand/{{$brand_pro->brand_id}}"> <span class="pull-right">(50)</span>{{$brand_pro->brand_name}}</a></li>
									@endforeach
									
								
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="{{asset('public/frontend/images/mau-thiet-ke-giam-gia-iphone-400x400.jpg')}}" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>