@extends('welcome')
@section('sibar_left')
@include('pages.inc.sibar_left')
@endsection
@section('content')
		<div class="blog-post-area">
						<h2 class="title text-center">Bài viết</h2>
						
						<div class="single-blog-post">
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							
							<p><b>{{$blog->blog_title}}</b></p>
							<p>{!!$blog->blog_content!!}</p>
						</div>
				        <div class="fb-comments" data-href="https://firstphpweb.000webhostapp.com/" data-width="" data-numposts="5"></div>
						<div class="pagination-area">
							<ul class="pagination">
								<li><a href="" class="active">1</a></li>
								<li><a href="">2</a></li>
								<li><a href="">3</a></li>
								<li><a href=""><i class="fa fa-angle-double-right"></i></a></li>
							</ul>
						</div>
					</div>	
					<div id="fb-root"></div>		
					<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v15.0&appId=695872028369099&autoLogAppEvents=1" nonce="8iqIR2dB"></script>
@endsection