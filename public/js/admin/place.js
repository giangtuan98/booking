
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

