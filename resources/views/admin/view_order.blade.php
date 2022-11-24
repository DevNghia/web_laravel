@extends('admin_layout')
@section('admin_content')
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua
    </div>
    
    <?php
	$message = Session()->get('message');
	if($message){
		echo '<span class="tex-aler">'.$message.'</span>';
		Session()->put('message',null);
	}
	?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên khách hàng </th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
            
          
            <td>{{$customer->customer_name}}</td>
           <td>{{$customer->customer_phone}}</td>
           <td>{{$customer->customer_email}}</td>
            
           
          </tr>
         
        
        </tbody>
      </table>
    </div>
    
  </div>
</div>
        
         
        </div>
 <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người vận chuyển
    </div>
  
    <?php
	$message = Session()->get('message');
	if($message){
		echo '<span class="tex-aler">'.$message.'</span>';
		Session()->put('message',null);
	}
	?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
           <th>Tên shipper </th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
            
            
          </tr>
        </thead>
        <tbody>
         
        
                <td>{{ $shipping->shipping_name}}</td>
                <td>{{ $shipping->shipping_address}}</td>
                <td>{{$shipping->shipping_phone}}</td>
                 <td>{{$shipping->shipping_email}}</td>
                  <td>{{$shipping->shipping_message}}</td>
                  
                @if ($shipping->shipping_method==0)
                    <td>Chuyển khoản</td>
                @else
                      <td>Tiền mặt</td>
                @endif
          
           
        </tbody>
      </table>
    </div>
   
  </div>
</div>
        
         
        </div>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <?php
	$message = Session()->get('message');
	if($message){
		echo '<span class="tex-aler">'.$message.'</span>';
		Session()->put('message',null);
	}
	?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:250px;">
              STT
            </th>
            <th>Tên sản phẩm </th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
         @php
             $i=1;
             $total=0;
         @endphp
          @foreach ( $order_details as $key => $detail)
           @php
              
              
              $subtotal= $detail->product_sales_quantity*$detail->product_price;
              $total+=$subtotal;
          @endphp
          <tr>
            <td>{{$i++}}</td>
            <td>{{$detail->product_name}}</td>
           <td>{{$detail->product_sales_quantity}}</td>
            <td>{{$detail->product_price}}</td>
            <td>{{number_format($detail->product_sales_quantity*$detail->product_price).' '.'VND'}}</td>
           
          </tr>
          
        @endforeach
         
          
          
       
        <tr>
          
       @foreach ($order as $key=>$ord)
              <td>Tổng: {{number_format($ord->order_total).' '.'VND'}}(đã bao gồm phí phận chuyển)<br>
                  
                  @if ($ord->order_total_after==0)
                       Tiền sau giảm: {{number_format($ord->order_total).' '.'VND'}}
                  @else
                      Tiền sau giảm: {{number_format($ord->order_total_after).' '.'VND'}}
                  @endif
              </td>
        
       @endforeach
            
          
          
        </tr>
        </tbody>
        
      </table>
      
    </div>
    <footer class="panel-footer">
      <div class="row">
        @foreach ($order_details as $detail)
            
        @endforeach
       <a target="blank" href="\print-order\{{$detail->order_code}}">In ra PDF</a>
       
      </div>
    </footer>
  </div>
</div>
        
         
        </div>
@endsection