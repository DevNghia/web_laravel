@extends('welcome')

@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
                <?php
                    $content =Cart::content();
					
                    ?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sp</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@php
							$total=0;
						@endphp
						@foreach ($content as $key=>$v_content)
							@php
								$subtotal = $v_content->price * $v_content->qty;
								$total+=$subtotal;
							@endphp
						
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{'/public/uploads/product/'.$v_content->options->image}}"  width="50px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Mã ID:{{$v_content->id}}</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' '.'vnđ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="/update-quantity-cart" method="post">
										{{csrf_field()}}
									{{-- <a class="cart_quantity_up" href=""> - </a> --}}
									<input class="cart_quantity_input" type="number" name="cart_quantity" value="{{$v_content->qty}}" autocomplete="off" size="2">
										<input type="hidden" name="rowId_cart" value="{{$v_content->rowId}}" class="form-control">
									<input type="submit" value="Cập nhật"  class="btn btn-default btn-sm">
									{{-- <a class="cart_quantity_down" href=""> + </a> --}}
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal).' '.'vnđ'}}
								</p>
							</td>

							<td class="cart_delete">
								<a class="cart_quantity_delete" href="/delete-cart/{{$v_content->rowId}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			{{-- <div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> --}}
			<div class="row">
				{{-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							
							<li>Tổng <span>{{number_format($total).' '.'vnđ'}}</span></li>
							<li>
								Mã giảm : 
								@if (Session()->get('voucher'))
									@foreach (Session()->get('voucher') as $key =>$vou)
										@if ($vou['voucher_condition']==1)
											<span>{{$vou['voucher_number']}}%</span>	
											<p>
												@php
												$total_voucher = ($total*$vou['voucher_number'])/100;
												echo '<li>Tổng giảm: <span>'.number_format($total_voucher).' '.'vnđ'.'</span></li>'
												@endphp
											</p>
										@else  
											<span>{{number_format($vou['voucher_number']).' '.'vnđ'}}</span>
											<p>
												@php
												$total_voucher = ($vou['voucher_number']);
												echo '<li>Tổng giảm: <span>'.number_format($total_voucher).' '.'vnđ'.'</span></li>'
												@endphp
											</p>
										@endif
										<li>Tiền sau giảm <span>{{number_format($total-$total_voucher).' '.'vnđ'}}</span></li>
									@endforeach
								@endif
							</li>
							<form action="check-voucher" method="post">
								@csrf
							<li><input type="text" name="voucher" placeholder="Nhập voucher...">
								<span><input type="submit" value="Tính mã giảm giá"></span>
							</li>
							</form>
							
						</ul>
							{{-- <a class="btn btn-default update" href="">Update</a> --}}
							<?php
									$customer_id = Session()->get('customer_id');
									if($customer_id!=NULL){
								?>
								<a class="btn btn-default check_out" href="/checkout">Đặt hàng</a>
								<?php
								}else{
								?>
								<a class="btn btn-default check_out" href="/login-checkout">Đặt hàng</a>
								<?php
								}
								?>
							
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
    @endsection