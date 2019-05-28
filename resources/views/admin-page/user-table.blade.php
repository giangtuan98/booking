@extends('admin-page.admin-sb')
@section('tittle')
Admin-User
@endsection
@section('link')
Users
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
    <button class="btn btn-dark ml-auto" data-toggle="modal" data-target="#announce_userDiv" id="btn-add-user">Thêm</button>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th></th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created_at</th>
            <th>Updated_at</th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          @foreach($tbl_user as $user)
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role_name}}</td>
            <td>{{$user->created_at}}</td>
            <td>{{$user->updated_at}}</td>
            <td>
              <button class="btn btn-primary mr-2 update-user" data-user-id="{{$user->id}}" data-user-name="{{$user->name}}" data-email="{{$user->email}}" data-role-id="{{$user->role_id}}" data-toggle="modal" data-target="#announce_userDiv">Sửa</button>
              <button class="btn btn-secondary del-user" data-user-id="{{$user->id}}" data-user-name="{{$user->name}}" data-email="{{$user->email}}" data-role-name="{{$user->role_name}}" data-toggle="modal" data-target="#delUserDiv">Xóa</button></td>
            </tr>

            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  @endsection
  @section('action-form')
  <div class="modal fade" id="announce_userDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document" style="margin-top: 100px;">
      <div class="modal-content">
        <div class="card-header">
          <span>Thêm người dùng</span>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="card-body">
          <form >
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <div class="form-group">
                <div class="form-label-group">
                  <input type="text" id="inputUserName" class="form-control" placeholder="Name" required="required">
                  <label for="inputUserName">Name</label>
                </div>
              </div>
              <div class="form-label-group">
                <input type="password" id="inputUserPassword" class="form-control" placeholder="Password" required="required" autofocus="autofocus">
                <label for="inputUserPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputUserConfirmPassword" class="form-control" placeholder="Confirm Password" required="required">
                <label for="inputUserConfirmPassword">Confirm Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="required">
                <label for="inputEmail">Email</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <select class="form-control-lg w-100 " id="selectRoleId" style="font-size: 1rem;" >
                  <option value="">Role</option>
                  @foreach($tbl_role as $role)
                  <option value="{{$role->role_id}}">{{$role->role_name}}</option>
                  @endforeach
                </select> 
              </div>
            </div>
            
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-block" id="action-user-button" data-user-id="">Thêm</button>
          {{-- <button class="btn btn-primary btn-block" id="action-user-button">Thêm</button> --}}
        </div>
      </div>
    </div>
  </div>
  {{-- Delete Form --}}
  <div class="modal fade" id="delUserDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 420px!important; margin-top: 100px;">
      <div class="modal-content ">
        <div class="alert alert-danger mb-0" role="alert">
          <h4 class="alert-danger">Bạn có muốn xóa dữ liệu này ?</h4>
          <p id="pUserName"></p>
          <p id="pEmail"></p>
          <p id="pRoleName"></p>
          <p id="pArriveTime"></p>
          <p id="pRouteId"></p>
          <p id="pCarId"></p>
          <hr>
          <button class="btn-primary btn float-right" id="btn-del-user" >Xóa</button>
          <p id='announce_del_user' class="text-danger"></p>
        </div>
      </div>
    </div>
  </div>
  @endsection