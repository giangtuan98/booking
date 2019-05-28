$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$("div.flash-alert").delay(5000).slideUp();
$("#changePass-button").unbind('click');
$("#changePass-button").click(function () {

  var uid = $(this).attr('data-login-id');
  var password = $('#inputPassword').val().trim();
  var rePassword = $('#inputConfirmPassword').val().trim();
  data = {uid, password, rePassword};
  route = 'changePassword';
  changPass_ajax(data, route);
});

function changPass_ajax(data, route) {
  $.ajax({
    type:'POST',
    url: route,
    data: {id: data.uid, inputPassword: data.password, inputConfirmPassword: data.rePassword},
    success:function(data){
      if(data.success === true){
        window.location.reload();
      }
      else{
        alert('Khong thanh cong');
      }
    },
    error: function (data, textStatus, errorThrown) {
      console.log(data);
      displayError(data);
    }
  });
}

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
    action_route = 'updatePlace';
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
  var del_route = 'delPlace';
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
$('#btn-add-route').unbind('click');
$('#btn-add-route').click(function (){
  document.getElementById("route_id").readOnly = false;
  document.getElementById("route_id").value = null;
  document.getElementById("route_name").value = null;
  document.getElementById("departure").value = "";
  document.getElementById("destination").value = "";
  document.getElementById("duration").value = null;
  document.getElementById("price").value = null;
  document.getElementById("action-route-button").setAttribute("action", 'add');
});

$("#action-route-button").unbind('click');
$("#action-route-button").click(function (e) {
  var route_id = $('#route_id').val().trim();
  var route_name = $('#route_name').val().trim();
  var departure = document.getElementById('departure').value;
  var destination = document.getElementById('destination').value;
  var duration = $('#duration').val().trim();
  var price = $('#price').val().trim();
  var action = $(this).attr('action');
  var flag = true;
  var action_route = 'addRoute';
  if (action == 'update') {
    action_route = 'updateRoute';
  } 
  data = {route_id, route_name, departure, destination, duration, price}
  route_ajax(data, action_route, "announce_route");
});

$(".update-route").unbind('click');
$(".update-route").click(function (e) { 
  var route_id = $(this).attr('data-route-id');
  document.getElementById("route_id").value = route_id;
  document.getElementById("route_name").value = $(this).attr('data-route-name');
  document.getElementById("departure").value = $(this).attr('data-departure');
  document.getElementById("destination").value = $(this).attr('data-destination');
  document.getElementById("duration").value = $(this).attr('data-duration');
  document.getElementById("price").value = $(this).attr('data-price');
  document.getElementById("route_id").readOnly = true;
  document.getElementById("action-route-button").setAttribute("action", 'update');
  clearErrorText();
  clearBorderError();
});

$(".del-route").unbind('click');
$(".del-route").click(function (e) { 
  document.getElementById("btn-del-route").setAttribute("data-route-id", $(this).attr('data-route-id'));
  $('#pRouteId').html("Mã tuyến :" + $(this).attr('data-route-id'));
  $('#pRouteName').html("Tên tuyến :" + $(this).attr('data-route-name'));
  $('#pDeparture').html("Điểm đi :" + $(this).attr('data-departure'));
  $('#pDestination').html("Điểm đến :" + $(this).attr('data-destination'));
  $('#pDuration').html("Thời gian :" + $(this).attr('data-duration'));
  $('#pPrice').html("Giá :" + $(this).attr('data-price'));
});

$("#btn-del-route").unbind('click');
$("#btn-del-route").click(function (e) { 
  var route_id = $(this).attr('data-route-id');
  var del_route = 'delRoute';
  var data = {route_id};
  route_ajax(data, del_route, 'announce_del_route');
});

function route_ajax(data, route, id) {
  $.ajax({
    type:'POST',
    url: route,
    data: {route_id: data.route_id, route_name: data.route_name, departure: data.departure,
      destination: data.destination, duration: data.duration, price: data.price},
      success:function(data){
        if(data.success === true){
          location.reload();
        }else{
          document.getElementById(id).innerHTML = "Thực hiện thất bại" ;
        }
      },
      error: function (data, textStatus, errorThrown) {
          // alert(data.msg);
          console.log(data);
          displayError(data);
        },
      });
}

$('#btn-add-user').unbind('click');
$('#btn-add-user').click(function (){
  document.getElementById("action-user-button").setAttribute("action", 'add');
});

$("#action-user-button").unbind('click');
$("#action-user-button").click(function (e) {
  var user_id = $(this).attr('data-user-id');
  var user_name = $('#inputUserName').val().trim();
  var email = $('#inputEmail').val().trim();
  var role_id = document.getElementById("selectRoleId").value;
  var password = $('#inputUserPassword').val().trim();
  var confirm_password = $('#inputUserConfirmPassword').val().trim();
  var action = $(this).attr('action');
  var action_user = 'addUser';
  if (action == 'update') {
    action_user = 'updateUser';
  } 
  data = {user_id, user_name, email, role_id, password, confirm_password}
      // document.forms['formtest'].submit();
      user_ajax(data, action_user, "announce_user");
    // }
  });

$(".update-user").unbind('click');
$(".update-user").click(function (e) { 
  document.getElementById("inputUserName").value = $(this).attr('data-user-name');
  document.getElementById("inputEmail").value = $(this).attr('data-email');
  document.getElementById("inputEmail").readOnly = true;
  document.getElementById("selectRoleId").value = $(this).attr('data-role-id');
  document.getElementById("action-user-button").setAttribute("action", 'update');
  document.getElementById("action-user-button").setAttribute("data-user-id", $(this).attr('data-user-id'));
});

$(".del-user").unbind('click');
$(".del-user").click(function (e) { 
  document.getElementById("btn-del-user").setAttribute("data-user-id", $(this).attr('data-user-id'));
  $('#announce_del_buses').html("");
  $('#pUserName').html("Name : " +  $(this).attr('data-user-name'));
  $('#pEmail').html("Email : " + $(this).attr('data-email'));
  $('#pRoleName').html("Role : " + $(this).attr('data-role-name'));
});

$("#btn-del-user").unbind('click');
$("#btn-del-user").click(function (e) { 
  alert('hello');
  var user_id = $(this).attr('data-user-id');
  var del_route = 'delUser';
  var data = {user_id};
  user_ajax(data, del_route, 'announce_del_buses');
});

function user_ajax(data, route, id) {
  $.ajax({
    type:'POST',
    url: route,
    data: {user_id:data.user_id, inputUserName: data.user_name, inputEmail: data.email,
      selectRoleId: data.role_id, inputUserPassword: data.password, inputUserConfirmPassword: data.confirm_password},
      success:function(data){
        if(data.success === true){
          location.reload();
        }
        else{
          $(id).html("Xóa tài khoản không thành công");
        }
      },
      error: function (data, textStatus, errorThrown) {
        console.log(data);
        displayError(data);
      }
    });
}
function displayError(data) {
  var errors = data.responseJSON.errors;
  var firstItem = Object.keys(errors)[0];
  var firstItemDOM = document.getElementById(firstItem);
  var firstErrorMessage = errors[firstItem][0];

          // scroll to te error message
          firstItemDOM.scrollIntoView();
          
          // remove all error messages
          clearErrorText();
          // // show error message
          firstItemDOM.insertAdjacentHTML('afterend', `<p class="text-danger m-0" style="font-size: 13px;">* ${firstErrorMessage}</div>`)

          // remove all form controls with highlighted error text box
          clearBorderError();
          // highlight the form control with the error 
          firstItemDOM.classList.add('border', 'border-danger');
        }

        function clearErrorText(){
          var errorMessages = document.querySelectorAll('.text-danger');
          errorMessages.forEach((element)=>element.textContent = '');
        }
        function clearBorderError() {
          var formControls = document.querySelectorAll('.form-control')
          formControls.forEach((element)=> element.classList.remove('border', 'border-danger'));
        }
