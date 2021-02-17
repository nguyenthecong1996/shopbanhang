@extends('admin_layout')
@section('content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người đặt
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người gửi</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
                {{$dataAll['getUser']['name']}}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
   <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Người nhận</th>
            <th>Số ĐT</th>
            <th>Địa chỉ</th>
            <!-- <th>Ngày Thêm</th> -->
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
           <tr>
            <td>
              {{$dataAll['getInfoShipping']['shipping_name']}}
            </td>
             <td>
              {{$dataAll['getInfoShipping']['shipping_phone']}}
            </td>
             <td>
              {{$dataAll['getInfoShipping']['shipping_address']}}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Mã giám giá</th>
              <th>Số lượng</th>
              <th>Gía tiền</th>
              <th>Tổng tiền</th>
              <!-- <th>Ngày Thêm</th> -->
              <th style="width:30px;"></th>
            </tr>
          </thead>
          @php
            $total = 0;
            $i = 0;
          @endphp
          <tbody>
            @foreach($dataAll['getOrderDetail'] as $item)
              @php
                $total += $item->product_price*$item->product_sales_quantity;
              @endphp
            <tr>
              <td>{{$i++}}</td>
              <td>{{$item->product_name}}</td>
              <td>
                @if(isset($dataAll['stringCoupon']))
                  {{$dataAll['stringCoupon']}}
                @else
                  Không mã  
                @endif  
              </td>
              <td>{{$item->product_sales_quantity}}</td>
              <td>{{$item->product_price}}</td>
              <td>{{$item->product_price*$item->product_sales_quantity}}</td>
            </tr>
          @endforeach
            <tr>
              <td>
                Tổng tiền ban đầu: {{$total}}    
              </td>
              <td>
                Tổng giảm : {{$dataAll['userid']['total_coupon']}}    
              </td>
              <td>
                Tổng tiền : {{$total - $dataAll['userid']['total_coupon']}}    
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>

@endsection