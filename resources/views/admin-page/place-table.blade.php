@extends('admin-page.admin-sb')
@section('tittle')
Admin-Location
@endsection
@section('link')
Điểm
@endsection
@section('table')
@if (session('success_message'))
<div class="alert alert-success flash-alert">
  {{ session('success_message') }}
</div>
@endif
<div class="card mb-3">
  <div class="card-header">
    <div class="card-header d-flex align-items-baseline">
      <span><i class="fas fa-table"></i>Danh sách điểm</span>
      <button class="btn btn-dark ml-auto" data-toggle="modal" data-target="#addPlaceDiv" id="btn-add-place">Thêm</button>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Mã điểm</th>
            <th>Tên điểm</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Mã điểm</th>
            <th>Tên điểm</th>
            <th>Hành động</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($tbl_place as $place)
          <tr>
            <td>{{$place->place_id}}</td>
            <td>{{$place->place_name}}</td>
            <td class="d-flex justify-content-center"
            ><button class="btn btn-primary mr-2 update-place" data-place-id="{{$place->place_id}}" data-place-name="{{$place->place_name}}" data-toggle="modal" data-target="#addPlaceDiv">Sửa</button><button class="btn btn-secondary del-place" data-place-id="{{$place->place_id}}" data-place-name="{{$place->place_name}}" data-toggle="modal" data-target="#delPlaceDiv" @if(Auth::user()->role_id != 1) disabled="disabled" @endif>Xóa</button></td>
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
{{-- Add Form --}}
<div class="modal fade" id="addPlaceDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 420px!important; margin-top: 100px;">
    <div class="modal-content ">
      <div class="card-header">
        <span>Thêm điểm</span>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="place_id" class="form-control" placeholder="Mã điểm" required="required" autofocus="autofocus" >
              <label for="place_id">Mã điểm</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="place_name" class="form-control" placeholder="Tên điểm" required="required">
              <label for="place_name">Tên điểm</label>
            </div>
          </div>
          <p id='announce_place' class="text-danger"></p>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary btn-block" id="action-place-button" action="add">Thêm</button>
      </div>
    </div>
  </div>
</div>

{{-- Delete Form --}}
<div class="modal fade" id="delPlaceDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 420px!important; margin-top: 100px;">
    <div class="modal-content ">
      <div class="alert alert-danger mb-0" role="alert">
        <h4 class="alert-danger">Bạn có muốn xóa dữ liệu này ?</h4>
        <p id="pPlaceId"></p>
        <p id="pPlaceName"></p>
        <hr>
        <button class="btn-primary btn float-right" id="btn-Del-Place" data-place-id = "0">Xóa</button>
        <p id='announce_del_place' class="text-danger"></p>
      </div>
    </div>
  </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript"></script>
{{-- <script>
  $('#btn-add-place').unbind('click');
  $('#btn-add-place').click(function (){
    document.getElementById("place_id").readOnly = false;
    document.getElementById("place_id").value = null;
    document.getElementById("place_name").value = null;
    document.getElementById("action-place-button").setAttribute("action", 'add');
  });

  $("#action-place-button").unbind('click');
  $("#action-place-button").click(function (e) {
    var place_id = $('#place_id').val().trim();
    var place_name = $('#place_name').val().trim();
    var action = $(this).attr('action');
    var action_route = 'addPlace';
    if (action == 'update') {
      action_route = '{{route("updatePlace")}}';
    }
    var data = {place_id, place_name};
   place_ajax(data, action_route, "announce_place");
});
  
  $(".update-place").unbind('click');
  $(".update-place").click(function (e) { 
    document.getElementById("place_id").value =  $(this).attr('data-place-id');
    document.getElementById("place_name").value =  $(this).attr('data-place-name');
    document.getElementById("place_id").readOnly = true;
    document.getElementById("action-place-button").setAttribute("action", 'update');
    clearErrorText();
    clearBorderError();
  });

  $(".del-place").unbind('click');
  $(".del-place").click(function (e) { 
    var place_id = $(this).attr('data-place-id');
    var place_name = $(this).attr('data-place-name');
    document.getElementById("btn-Del-Place").setAttribute("data-place-id", place_id);
    document.getElementById("btn-Del-Place").setAttribute("data-place-name", place_name);
    $('#pPlaceId').html("Mã điểm :" + place_id);
    $('#pPlaceName').html("Tên điểm :" + $(this).attr('data-place-name'));
  });

  $("#btn-Del-Place").unbind('click');
  $("#btn-Del-Place").click(function (e) { 
    var place_id = $(this).attr('data-place-id');
    var place_name = $(this).attr('data-place-name');
    var del_route = '{{route('delPlace')}}';
    data = {place_id, place_name};
    place_ajax(data, del_route, 'announce_del_place');
  });

  function place_ajax(data, route, id) {
    $.ajax({
      type:'POST',
      url: route,
      data: {place_id: data.place_id, place_name:data.place_name},
      success:function(data){
        if(data.success === true){
          location.reload();
        }else{
          document.getElementById(id).innerHTML = "Không thể xóa dữ liệu này" ;
          }
        },
        error: function (data, textStatus, errorThrown) {
          console.log(data);
          displayError(data);
        },
      });
  }
  
</script> --}}
@endsection