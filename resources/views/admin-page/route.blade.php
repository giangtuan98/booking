@extends('admin-page.admin-sb')
@section('link')
Tuyến xe
@endsection
@section('table')
@if (session('success_message'))
<div class="alert alert-success flash-alert">
  {{ session('success_message') }}
</div>
@endif
<div class="card mb-3">
  <div class="card-header d-flex align-items-baseline">
    <span><i class="fas fa-table"></i>Danh sách tuyến</span>
    <button class="btn btn-dark ml-auto" data-toggle="modal" data-target="#addRouteDiv" id="btn-add-route">Thêm</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã tuyến</th>
            <th>Tên tuyến</th>
            <th>Điểm đi</th>
            <th>Điểm đến</th>
            <th>Thời gian</th>
            <th>Giá</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Mã tuyến</th>
            <th>Tên tuyến</th>
            <th>Điểm đi</th>
            <th>Điểm đến</th>
            <th>Thời gian</th>
            <th>Giá</th>
            <th>Hành động</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($tbl_route as $route)
          <tr>
            <td>{{$route->route_id}}</td>
            <td>{{$route->route_name}}</td>
            <td>{{$route->departure}}</td>
            <td>{{$route->destination}}</td>
            <td>{{$route->duration}}</td>
            <td>{{$route->price}}</td>
            <td><button class="btn btn-primary mr-2 update-route" data-route-id="{{$route->route_id}}" data-route-name="{{$route->route_name}}" data-departure="{{$route->departure}}" data-destination="{{$route->destination}}" data-duration="{{$route->duration}}" data-price="{{$route->price}}" data-toggle="modal" data-target="#addRouteDiv">Sửa</button>
              <button class="btn btn-secondary del-route" data-route-id="{{$route->route_id}}" data-route-name="{{$route->route_name}}" data-departure="{{$route->departure}}" data-destination="{{$route->destination}}" data-duration="{{$route->duration}}" data-price="{{$route->price}}" data-toggle="modal" data-target="#delRouteDiv" @if(Auth::user()->role_id != 1) disabled="disabled" @endif>Xóa</button></td>
          </tr>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
</div>
@endsection
@section('action-form')
<div class="modal fade" id="addRouteDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog " role="document" style="margin-top: 100px;">
    <div class="modal-content">
      <div class="card-header">
        <span>Thêm tuyến</span>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input min="0" max="200" type="number"  id="route_id" class="form-control" placeholder="Mã tuyến" required="required" autofocus="autofocus">
                  <label for="route_id">Mã tuyến</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="route_name" class="form-control" placeholder="Tên tuyến" required="required">
              <label for="route_name">Tên tuyến</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <select class="form-control-lg w-100 " id="departure" style="font-size: 1rem;" >
                    <option value="">Điểm đi</option>
                    @foreach($places as $key => $value)
                      <option value="{{$key}}">{{$key. '-' .$value}}</option>
                    @endforeach
                  </select>       
            </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select class="form-control-lg w-100 " style="font-size: 1rem;" id="destination">
                    <option value="">Điểm đến</option>
                    @foreach($places as $key => $value)
                      <option value="{{$key}}">{{$key. '-' .$value}}</option>
                    @endforeach
                  </select>       
            </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="duration" class="form-control" placeholder="h:m:s" required="required" />
                  <label for="duration">Thời gian (h:m:s)</label>             
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="number" id="price" class="form-control" placeholder="Giá" required="required">
              <label for="price">Giá</label>
                </div>
              </div>
            </div>
          </div>
          <p id='announce_route' class="text-danger"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-block" id="action-route-button">Thêm</button>
      </div>
    </div>
  </div>
</div>
{{-- Delete Form --}}
<div class="modal fade" id="delRouteDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 420px!important; margin-top: 100px;">
    <div class="modal-content ">
      <div class="alert alert-danger mb-0" role="alert">
        <h4 class="alert-danger">Bạn có muốn xóa dữ liệu này ?</h4>
        <p id="pRouteId"></p>
        <p id="pRouteName"></p>
        <p id="pDeparture"></p>
        <p id="pDestination"></p>
        <p id="pDuration"></p>
        <p id="pPrice"></p>
        <hr>
        <button class="btn-primary btn float-right" id="btn-del-route" data-place-id = "0">Xóa</button>
        <p id='announce_del_route' class="text-danger"></p>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>

  // $('#btn-add-route').unbind('click');
  // $('#btn-add-route').click(function (){
  //   document.getElementById("route_id").readOnly = false;
  //   document.getElementById("route_id").value = null;
  //   document.getElementById("route_name").value = null;
  //   document.getElementById("departure").value = "";
  //   document.getElementById("destination").value = "";
  //   document.getElementById("duration").value = null;
  //   document.getElementById("price").value = null;
  //   document.getElementById("action-route-button").setAttribute("action", 'add');
  // });

  // $("#action-route-button").unbind('click');
  // $("#action-route-button").click(function (e) {
  //     var route_id = $('#route_id').val().trim();
  //     var route_name = $('#route_name').val().trim();
  //     var departure = document.getElementById('departure').value;
  //     var destination = document.getElementById('destination').value;
  //     var duration = $('#duration').val().trim();
  //     var price = $('#price').val().trim();
  //     var action = $(this).attr('action');
  //     var flag = true;
  //     var action_route = 'addRoute';
  //     if (action == 'update') {
  //       action_route = 'updateRoute';
  //     } 
  //     data = {route_id, route_name, departure, destination, duration, price}
  //     route_ajax(data, action_route, "announce_route");
  // });
  
  // $(".update-route").unbind('click');
  // $(".update-route").click(function (e) { 
  //   var route_id = $(this).attr('data-route-id');
  //   document.getElementById("route_id").value = route_id;
  //   document.getElementById("route_name").value = $(this).attr('data-route-name');
  //   document.getElementById("departure").value = $(this).attr('data-departure');
  //   document.getElementById("destination").value = $(this).attr('data-destination');
  //   document.getElementById("duration").value = $(this).attr('data-duration');
  //   document.getElementById("price").value = $(this).attr('data-price');
  //   document.getElementById("route_id").readOnly = true;
  //   document.getElementById("action-route-button").setAttribute("action", 'update');
  //   clearErrorText();
  //   clearBorderError();
  // });

  // $(".del-route").unbind('click');
  // $(".del-route").click(function (e) { 
  //   document.getElementById("btn-del-route").setAttribute("data-route-id", $(this).attr('data-route-id'));
  //   $('#pRouteId').html("Mã tuyến :" + $(this).attr('data-route-id'));
  //   $('#pRouteName').html("Tên tuyến :" + $(this).attr('data-route-name'));
  //   $('#pDeparture').html("Điểm đi :" + $(this).attr('data-departure'));
  //   $('#pDestination').html("Điểm đến :" + $(this).attr('data-destination'));
  //   $('#pDuration').html("Thời gian :" + $(this).attr('data-duration'));
  //   $('#pPrice').html("Giá :" + $(this).attr('data-price'));
  // });

  // $("#btn-del-route").unbind('click');
  // $("#btn-del-route").click(function (e) { 
  //   var route_id = $(this).attr('data-route-id');
  //   var del_route = '{{route('delRoute')}}';
  //   var data = {route_id};
  //   route_ajax(data, del_route, 'announce_del_route');
  // });

  // function route_ajax(data, route, id) {
  //   $.ajax({
  //       type:'POST',
  //       url: route,
  //       data: {route_id: data.route_id, route_name: data.route_name, departure: data.departure,
  //         destination: data.destination, duration: data.duration, price: data.price},
  //       success:function(data){
  //         if(data.success === true){
  //           location.reload();
  //         }else{
  //           document.getElementById(id).innerHTML = "Thực hiện thất bại" ;
  //         }
  //       },
  //       error: function (data, textStatus, errorThrown) {
  //         // alert(data.msg);
  //         console.log(data);
  //         displayError(data);
  //       },
  //     });
  // }

</script>
@endsection