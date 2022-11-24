@extends('admin_layout')
@section('admin_content')
     <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật bài viết
                        </header>
                        <?php
	$message = Session()->get('message');
	if($message){
		echo '<span class="tex-aler">'.$message.'</span>';
		Session()->put('message',null);
	}
	?>
                        <div class="panel-body">
                            <div class="position-center">
                                @foreach ($edit_blog as $key=>$edit_bl)
                                <form role="form" id="formValidation" action="/update-blog/{{$edit_bl->blog_id}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu đề bài viết</label>
                                    <input type="text" name="blog_title" value="{{$edit_bl->blog_title}}"  class="form-controls" >
                                </div>
                                 
                                 <div class="form-group">
                                    <label >Hình ảnh bài viết</label>
                                    <input type="file"  name="blog_image" value="{{$edit_bl->blog_image}}" class="form-control"  accept="image/*">
                                    <img src="/public/uploads/product/{{$edit_bl->blog_image}}" width="100px" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea id="hidden_snippet" style="resize: none " rows="5" class="form-control" name="blog_content" > 
                                    {{$edit_bl->blog_content}}
                                    </textarea>
                                </div>
                              
                                <button type="submit" name="update_blog" class="btn btn-info">Cập nhật bài viết</button>
                                
                            </form>
                            </div>
                            
                        </div>
                        @endforeach
                    </section>

            </div>
         
        </div>
@endsection