@extends('admin_layout')
@section('admin_content')
     <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Banner
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
                                <form role="form" id="formValidation" action="/save-banner" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Banner</label>
                                    <input type="text" name="banner_name" class="form-controls"  placeholder="Tên banner">
                                </div>
                              
                                 <div class="form-group">
                                    <label >Hình ảnh Banner</label>
                                    <input type="file"  name="banner_image" class="form-control"  placeholder="ảnh banner" accept="image/*">
                                </div>
                                
                                <div class="form-group">
                                     <label for="exampleInputPassword1">Hiển thị</label>
                                   <select name="banner_status" class="form-control input-sm m-bot15">
                                    <option value="0">Ẩn</option>
                                     <option value="1">Hiển thị</option>
                                    
                                   </select>
                                </div>
                                <button type="submit" name="add_banner" class="btn btn-info">Thêm sản phẩm</button>
                                
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
         
        </div>
@endsection