@extends('admin-page.admin-sb')
@section('tittle')
Admin-Chuyến xe
@endsection
@section('link')
Chuyến xe
@endsection
@section('table')
@if (session('success_message'))
<div class="alert alert-success flash-alert">
  {{ session('success_message') }}
</div>
@endif
<div class="card mb-3">
  <div class="card-header d-flex align-items-baseline">
    <span><i class="fas fa-table"></i>Danh sách chuyến</span>
    <button class="btn btn-dark ml-auto" data-toggle="modal" data-target="#addBusesDiv" id="btn-add-buses">Thêm</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã chuyến</th>
            <th>Tên chuyến</th>
            <th>Giờ đi</th>
            <th>Giờ đến</th>
            <th>Mã tuyến</th>
            <th>Mã xe</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Mã chuyến</th>
            <th>Tên chuyến</th>
            <th>Giờ đi</th>
            <th>Giờ đến</th>
            <th>Mã tuyến</th>
            <th>Mã xe</th>
            <th>Hành động</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($tbl_buses as $bus)
          <tr>
            <td>{{$bus->buses_id}}</td>
            <td>{{$bus->buses_name}}</td>
            <td>{{$bus->depart_time}}</td>
            <td>{{$bus->arrive_time}}</td>
            <td>{{$bus->route_id}}</td>
            <td>{{$bus->car_id}}</td>
            <td><button class="btn btn-primary mr-2 update-buses" data-buses-id="{{$bus->buses_id}}" data-buses-name="{{$bus->buses_name}}" data-depart-time="{{$bus->depart_time}}" data-arrive-time="{{$bus->arrive_time}}" data-buses-id="{{$bus->route_id}}" data-car-id="{{$bus->car_id}}" data-route-id="{{$bus->route_id}}" data-toggle="modal" data-target="#addBusesDiv">Sửa</button>
              <button class="btn btn-secondary del-buses" data-buses-id="{{$bus->buses_id}}" data-buses-name="{{$bus->buses_name}}" data-depart-time="{{$bus->depart_time}}" data-arrive-time="{{$bus->arrive_time}}" data-buses-id="{{$bus->route_id}}" data-car-id="{{$bus->car_id}}" data-route-id="{{$bus->route_id}}" data-toggle="modal" data-target="#delBusesDiv" @if(Auth::user()->role_id != 1) disabled="disabled" @endif>Xóa</button></td>
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
<div class="modal fade" id="addBusesDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog " role="document" style="margin-top: 100px;">
    <div class="modal-content">
      <div class="card-header">
        <span>Thêm chuyến</span>
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
                  <input min="0" max="200" type="number"  id="buses_id" class="form-control" placeholder="Mã chuyến" required="required" autofocus="autofocus">
                  <label for="buses_id">Mã chuyến</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="buses_name" class="form-control" placeholder="Tên chuyến" required="required">
              <label for="buses_name">Tên chuyến</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="time" id="depart_time" class="form-control" placeholder="Giờ đi" required="required">
                  <label for="depart_time">Giờ đi</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="time" id="arrive_time" class="form-control" placeholder="Giờ đến" required="required">
                  <label for="arrive_time">Giờ đến</label>    
            </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <select class="form-control-lg w-100 " id="route_id" style="font-size: 1rem;" >
                    <option value="">Mã tuyến</option>
                    @foreach($tbl_route as $route)
                      <option value="{{$route->route_id}}">{{$route->route_id. '-' .$route->route_name}}</option>
                    @endforeach
                  </select>      
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <select class="form-control-lg w-100 " id="car_id" style="font-size: 1rem;" >
                    <option value="">Mã xe</option>
                    @foreach($tbl_car as $car)
                      <option value="{{$car->car_id}}">{{$car->car_id}}</option>
                    @endforeach
                  </select> 
                </div>
              </div>
            </div>
          </div>
          <p id='announce_buses' class="text-danger"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-block" id="action-buses-button">Thêm</button>
      </div>
    </div>
  </div>
</div>
{{-- Delete Form --}}
<div class="modal fade" id="delBusesDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 420px!important; margin-top: 100px;">
    <div class="modal-content ">
      <div class="alert alert-danger mb-0" role="alert">
        <h4 class="alert-danger">Bạn có muốn xóa dữ liệu này ?</h4>
        <p id="pBusesId"></p>
        <p id="pBusesName"></p>
        <p id="pDepartTime"></p>
        <p id="pArriveTime"></p>
        <p id="pRouteId"></p>
        <p id="pCarId"></p>
        <hr>
        <button class="btn-primary btn float-right" id="btn-del-buses" data-place-id = "0">Xóa</button>
        <p id='announce_del_buses' class="text-danger"></p>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
<script>
  $('#btn-add-buses').unbind('click');
  $('#btn-add-buses').click(function (){
    document.getElementById("buses_id").readOnly = false;
    document.getElementById("buses_id").value = null;
    document.getElementById("buses_name").value = null;
    document.getElementById("depart_time").value = null;
    document.getElementById("arrive_time").value = null;
    document.getElementById("route_id").value = "";
    document.getElementById("car_id").value = "";
    document.getElementById("action-buses-button").setAttribute("action", 'add');
  });

  $("#action-buses-button").unbind('click');
  $("#action-buses-button").click(function (e) {
      var buses_id = $('#buses_id').val().trim();
      var buses_name = $('#buses_name').val().trim();
      var depart_time = $('#depart_time').val().trim();
      var arrive_time = $('#arrive_time').val().trim();
      var route_id = document.getElementById('route_id').value;
      var car_id =  document.getElementById('car_id').value;
      var action = $(this).attr('action');
      var flag = true;
     
      var action_buses = 'addBuses';
      if (action == 'update') {
        action_buses = 'updateBuses';
      }
        data = {buses_id, buses_name, depart_time, arrive_time, route_id, car_id}
        buses_ajax(data, action_buses, "announce_buses");
      
  });
  
  $(".update-buses").unbind('click');
  $(".update-buses").click(function (e) { 
    document.getElementById("buses_id").value = $(this).attr('data-buses-id');
    document.getElementById("buses_name").value = $(this).attr('data-buses-name');
    document.getElementById("route_id").value = $(this).attr('data-route-id');
    document.getElementById("car_id").value = $(this).attr('data-car-id');
    document.getElementById("depart_time").value = $(this).attr('data-depart-time');
    document.getElementById("arrive_time").value = $(this).attr('data-arrive-time');
    document.getElementById("buses_id").readOnly = true;
    document.getElementById("action-buses-button").setAttribute("action", 'update');
    
  });

  $(".del-buses").unbind('click');
  $(".del-buses").click(function (e) { 
    var buses_id = $(this).attr('data-buses-id');
    document.getElementById("btn-del-buses").setAttribute("data-buses-id", buses_id);
    $('#announce_del_buses').html("");
    $('#pBusesId').html("Mã chuyến :" + buses_id);
    $('#pBusesName').html("Tên chuyến :" + $(this).attr('data-buses-name'));
    $('#pDepartTime').html("Giờ đi :" + $(this).attr('data-depart-time'));
    $('#pArriveTime').html("Giờ đến :" + $(this).attr('data-arrive-time'));
    $('#pRouteId').html("Mã tuyến :" + $(this).attr('data-route-id'));
    $('#pCarId').html("Mã xe :" + $(this).attr('data-car-id'));
  });

  $("#btn-del-buses").unbind('click');
  $("#btn-del-buses").click(function (e) { 
    var buses_id = $(this).attr('data-buses-id');
    var del_route = 'delBuses';
    var data = {buses_id};
    buses_ajax(data, del_route, 'announce_del_buses');
  });

  function buses_ajax(data, route, id) {
    $.ajax({
        type:'POST',
        url: route,
        data: {buses_id: data.buses_id, buses_name: data.buses_name, depart_time: data.depart_time,
          arrive_time: data.arrive_time, route_id: data.route_id, car_id: data.car_id},
        success:function(data){
          if(data.success === true){
            location.reload();
          }else{
            document.getElementById(id).innerHTML = data.msg ;
          }
        },
        error: function (data, textStatus, errorThrown) {
          console.log(data);
          displayError(data);
        },
      });
  }
</script>
@endsection