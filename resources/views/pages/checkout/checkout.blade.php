@extends('welcome')
@section('content')
<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/trang-chu">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->
            @php
				$content = Cart::content();
			@endphp
<form method="post">
           @csrf
<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-8">
						<div class="shopper-info">
							<p>Điền thông tin gửi hàng</p>
							
								<input type="email" name="shipping_email" class="shipping_email" placeholder="Email" required>
								<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên" required>
								<input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ" required>
								<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Phone" required>
                                <textarea name="shipping_message" class="shipping_message"  placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea>

								@if (Session()->get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="{{Session()->get('fee')}}">
								@else
									<input type="hidden" name="order_fee" class="order_fee" value="10000">
								@endif
								@if (Session()->get('voucher'))
									@foreach (Session()->get('voucher') as $key=>$vou)
										<input type="hidden" name="order_voucher" class="order_voucher" value="{{$vou['voucher_code']}}">
									@endforeach
								@else
									<input type="hidden" name="order_voucher" class="order_voucher" value="không có">
								@endif
								

								<label  for="exampleInputEmail1">Chọn hình thức thanh toán</label>
								 <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                        
                                    <option value="0">Thanh toán bằng chuyển khoản</option>
									 <option value="1">Thanh toán bằng tiền mặt</option>
									

                                    
                                   </select>
                               
							 <form role="form" id="formValidation" action="insert-delivery" method="post">
                                    {{ csrf_field() }}
                               
                                <div class="form-group">
                                    <label  for="exampleInputEmail1">Chọn thành phố</label>
                                     <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="">-Chọn tỉnh thành phố-</option>
                                    @foreach ($city as $key => $ci)
                                        <option value="{{$ci->matp}}">-{{$ci->name_city}}-</option>
                                    @endforeach
                                    
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label  for="exampleInputEmail1">Chọn quận huyện</label>
                                     <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        
                                    <option value="">-Chọn quận huyện-</option>

                                    
                                   </select>
                                </div>
                                  <div class="form-group">
                                    <label  for="exampleInputEmail1">Chọn xã phường</label>
                                     <select name="wards" id="wards" class="form-control input-sm m-bot15 wards ">
                                    <option value="">-Chọn xã phường-</option>

                                    
                                   </select>
                                </div>
                                
                                <input type="button" value="Tính phí vận chuyển" name="caculate_order" id="" class="btn btn-primary btn-sm calculate_delivery">
                                
                            </form>
							
						</div>
					</div>
			
									
				</div>
			</div>
			<div class="table-responsive cart_info">
                <form action="update-cart" method="post">
					{{ csrf_field() }}
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sp</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
				
					<tr>
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
						<td>
							@if (Session()->get('fee'))
							<li>
								<a class="cart_quantity_delete" href="del-fee"><i class="fa fa-times"></i></a>
								Phí vận chuyển: <span class="delivery">{{number_format(Session()->get('fee')).' '.'vnđ'}}</span></li>
								<li>Tổng: <span>{{number_format($total+ Session()->get('fee')).' '.'vnđ'}}</span></li>
								<input type="hidden" name="order_total" class="order_total" value="{{$total+ Session()->get('fee')}}">
							    @else 
								<li>Tổng: <span>{{number_format($total).' '.'vnđ'}}</span></li>
								<input type="hidden" name="order_total" class="order_total" value="{{$total}}">
						         @endif
						        <li>
								Mã giảm : 
								@if (Session()->get('voucher'))
									@foreach (Session()->get('voucher') as $key =>$vou)
										@if ($vou['voucher_condition']==1)
											<span>{{$vou['voucher_number']}}%</span>
											@if(Session()->get('fee'))
											<p>
												@php
												$total_voucher = (($total+ Session()->get('fee'))*$vou['voucher_number'])/100;
												echo '<li>Tổng giảm: <span>'.number_format($total_voucher).' '.'vnđ'.'</span></li>'
												@endphp
											</p>
											@else
											<p>
												@php
												$total_voucher = ($total*$vou['voucher_number'])/100;
												echo '<li>Tổng giảm: <span>'.number_format($total_voucher).' '.'vnđ'.'</span></li>'
												@endphp
											</p>
											@endif	
											
										@else
											<span>{{$vou['voucher_number']}}vnđ</span>
											<p>
												@php
												$total_voucher = ($vou['voucher_number']);
												echo '<li>Tổng giảm: <span>'.number_format($total_voucher).' '.'vnđ'.'</span></li>'
												@endphp
											</p>
										@endif
										<li>Tiền sau giảm <span>{{number_format($total+Session()->get('fee')-$total_voucher).' '.'vnđ'}}</span></li>
										<input type="hidden" name="order_total_after" class="order_total_after" value="{{$total+Session()->get('fee')-$total_voucher}}">
									@endforeach
								@else
								
										<input type="hidden" name="order_total_after" class="order_total_after" value="{{$total+Session()->get('fee')}}">
								@endif
							</li>
							<form action="check-voucher" method="post">
								@csrf
							<li><input type="text" name="voucher" placeholder="Nhập voucher...">
								<span><input type="submit" value="Tính mã giảm giá"></span>
							</li>
							</form>
							
						</td>
						
					</tr>
					
					</form>
					
				</table>
			</div>
   <input type="button" value="Xác nhận đơn hàng" name="send_oder" class="btn btn-primary btn-sm confirm">
							</form>
		<div class="container">
			{{-- <div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div> --}}
			
		</div>
	</section><!--/#do_action-->
          @endsection