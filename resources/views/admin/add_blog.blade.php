@extends('admin_layout')
@section('admin_content')
     <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm bài viết
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
                                <form role="form" id="formValidation" action="/save-blog" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu đề bài viết</label>
                                    <input type="text" name="blog_title" class="form-controls" >
                                </div>
                                 
                                 <div class="form-group">
                                    <label >Hình ảnh bài viết</label>
                                    <input type="file"  name="blog_image" class="form-control"  accept="image/*">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung bài viết</label>
                                    <textarea id="hidden_snippet" style="resize: none " rows="5" class="form-control" name="blog_content" > </textarea>
                                </div>
                              
                                <button type="submit" name="add_blog" class="btn btn-info">Thêm bài viết</button>
                                
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
         
        </div>
@endsection