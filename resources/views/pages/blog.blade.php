@extends('welcome')
@section('sibar_left')
@include('pages.inc.sibar_left')
@endsection
@section('content')
		<div class="blog-post-area">
						<h2 class="title text-center">Bài viết</h2>
						@foreach ($blog as $bl)
						<div class="single-blog-post">
							<div class="post-meta">
								
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="/blog-detail/{{$bl->blog_id}}">
								<img src="public/uploads/product/{{$bl->blog_image}}" alt="" />
							</a>
							<p><b>{{$bl->blog_title}}</b></p>
							<a  class="btn btn-primary" href="/blog-detail/{{$bl->blog_id}}">Đọc thêm</a>
						</div>
						@endforeach
						<div class="pagination-area">
							<ul class="pagination">
								  <span>{{$blog->links()}}</span>
								
							</ul>
						</div>
					</div>			
@endsection