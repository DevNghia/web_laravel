@extends('welcome')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="/">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>
            <div class="review-payment">
                <h2>Xem lại giỏ hàng</h2>
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
						@foreach ($content as $v_content)
							
						
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
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal).' '.'vnđ';
										?>
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
            <h4>Chọn hình thức thanh toán</h4><br>
            <div class="payment-options">
				<form action="/order-place" method="post">
					@csrf
                <span>
                    <label><input name="payment_option" value="1" type="checkbox">Trả bằng thẻ ATM</label>
                </span>
                <span>
                    <label><input name="payment_option" value="2" type="checkbox">Nhận tiền mặt</label>
                </span>
                <span>
                    <label><input name="payment_option" value="3" type="checkbox">Trả bằng thẻ ghi nợ</label>
                </span>
				<input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
				</form>
            </div>
		</div>
	</section> <!--/#cart_items-->
          @endsection