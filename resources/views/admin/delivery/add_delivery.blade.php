@extends('admin_layout')
@section('admin_content')
     <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm vận chuyển
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
                                <form role="form" id="formValidation" action="insert-delivery" method="post">
                                    {{ csrf_field() }}
                               
                                <div class="form-group">
                                    <label  for="exampleInputEmail1">Chọn thành phố</label>
                                     <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="0">-Chọn tỉnh thành phố-</option>
                                    @foreach ($city as $key => $ci)
                                        <option value="{{$ci->matp}}">-{{$ci->name_city}}-</option>
                                    @endforeach
                                    
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label  for="exampleInputEmail1">Chọn quận huyện</label>
                                     <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        
                                    <option value="0">-Chọn quận huyện-</option>

                                    
                                   </select>
                                </div>
                                  <div class="form-group">
                                    <label  for="exampleInputEmail1">Chọn xã phường</label>
                                     <select name="wards" id="wards" class="form-control input-sm m-bot15 wards ">
                                    <option value="0">-Chọn xã phường-</option>

                                    
                                   </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí Vận Chuyển</label>
                                    <input type="text"  name="delivery_pice" class="form-control fee_ship" id="delivery_price" >
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                                
                            </form>
                            </div>
                            <div id="load_delivery"></div>
                        </div>
                    </section>

            </div>
         
        </div>
@endsection