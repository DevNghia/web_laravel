@extends('admin_layout')
@section('admin_content')
     <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
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
                                @foreach ($edit_product as $key=>$edit_pro)
                                    
                                
                                <form role="form" action="/update-product/{{$edit_pro->product_id}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" value="{{$edit_pro->product_name}}" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" value="{{$edit_pro->product_price}}" class="form-control" id="exampleInputEmail1" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file"name="product_image" value="{{$edit_pro->product_image}}" class="form-control" id="exampleInputEmail1" >
                                    <img src="/public/uploads/product/{{$edit_pro->product_image}}" width="100px" >
                                    
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea  style="resize: none " rows="5"  class="form-control" name="product_desc" id="exampleInputPassword1" >
                                        {{$edit_pro->product_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Từ khóa sản phẩm</label>
                                    <textarea  style="resize: none " rows="5"  class="form-control" name="product_keywords" id="exampleInputPassword1" >
                                        {{$edit_pro->product_keywords}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea id="hidden_snippet" style="resize: none " rows="5"  class="form-control" name="product_content" id="exampleInputPassword1" >
                                        {{$edit_pro->product_content}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                     <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                   <select name="product_cate" class="form-control input-sm m-bot15">
                                    @foreach ($cate_product as $key=>$cate_pro)
                                    @if($cate_pro->category_id==$edit_pro->category_id)
                                        <option selected value="{{$cate_pro->category_id}}">{{$cate_pro->category_name}}</option>
                                        @else
                                        <option value="{{$cate_pro->category_id}}">{{$cate_pro->category_name}}</option>
                                        @endif
                                    @endforeach
                                   </select>
                                </div>
                                    <div class="form-group">
                                     <label for="exampleInputPassword1">Thương hiệu</label>
                                   <select name="product_brand" class="form-control input-sm m-bot15">
                                    @foreach ($brand_product as $key=> $brand_pro)
                                     @if($brand_pro->brand_id==$edit_pro->brand_id)
                                        <option selected value="{{$brand_pro->brand_id}}">{{$brand_pro->brand_name}}</option>
                                        @else
                                        <option value="{{$brand_pro->brand_id}}">{{$brand_pro->brand_name}}</option>
                                        @endif
                                     @endforeach
                                   </select>
                                </div>
                               
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật sản phẩm</button>
                                
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
         
        </div>
@endsection