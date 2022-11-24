@extends('welcome')
@section('content')
<section id="form"><!--form-->
	<?php
	$message = Session()->get('message');
	$error = Session()->get('error');
	if($message){
		echo '<span class="tex-aler">'.$message.'</span>';
		Session()->put('message',null);
	}else{
		echo '<span class="tex-aler-error">'.$error.'</span>';
		Session()->put('error',null);
	}
	?>
		<div class="container">
			
			
				<div class="col-sm-4 col-sm-offset-1">
					
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập tải khoản</h2>
						<form action="/login-customer" method="post">
							@csrf
							<input type="emali" name="email_account" placeholder="Email" />
							<input type="password" name="password_account" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký</h2>
						<form action="/add-customer" method="post">
                            {{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và Tên"/>
							<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
                            <input type="text" name="customer_phone" placeholder="Phone"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
     @endsection