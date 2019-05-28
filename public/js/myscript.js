// var bill, user_info, code, data_email;
//     $(".btnConfirmTicket").unbind('click');
//     $(".btnConfirmTicket").click(function () {
//         var confirmCodeText = document.getElementById('CaptchaCodeText').value;
//         if(confirmCodeText === code){
//             document.forms['form_step3'].submit();
//         }
//         else{
//             document.getElementById('notecaptcha').style.display = 'block';
//         }

//          });
//     function checkConfirmCode(data) {
//       $.ajax({
//         type:'POST',
//         url: 'checkConfirmCode',
//         dataType: "json",
//         data: {customername: data.customername, phone: data.phone, email: data.email,
//           address: data.address, quantity:data.quantity, price:data.price, departure:data.departure, destination: data.destination},
//           success:function(data){
//             if(data.success === true){
//                 gotostep(3);
//           	}else{
//             alert('Khong thanh cong');
//               // document.getElementById(id).innerHTML = "Thực hiện thất bại" ;
//           }
//       },
//       error: function (data, textStatus, errorThrown) {
//           var response = JSON.parse(data.responseText);
//           console.log(data);
//           // displayError(response.errors);
//       },
//   });
//   }
//     $(".btnGoToStep").unbind('click');
//     $(".btnGoToStep").click(function (e) {
//         e.preventDefault();
//         var step = $(this).attr('data-step');
//         gotostep(step);
//     });

//     $(".btnSetVehicleId").unbind('click');
//     $(".btnSetVehicleId").click(function () {
//         var id = $(this).attr('data-id');
//         var dep = $(this).attr('data-dep');
//         var des = $(this).attr('data-des');
//         var starttime = $(this).attr('data-starttime');
//         var date = $(this).attr('data-date');
//         var price = $(this).attr('data-price');
//         var datecheck = $(this).attr('data-datecheck');
//         // var eat = $(this).attr('data-eat');

//         var quantity = $(this).attr('data-quantity');
//         var dep_name = $(this).attr('data-dep-name');
//         var des_name = $(this).attr('data-des-name');
//         var des_time = $(this).attr('data-des-time');
//         var data_chuyen = $(this).attr('data-chuyen');
//         bill = {id: id, dep: dep, des: des, starttime: starttime, date: date, price: price, datecheck: date, quantity:quantity,
//             dep_name: dep_name, des_name: des_name, data_chuyen: data_chuyen};
//             gotostep(2);
//         });

//     var gotostep = function (step) {
//         jQuery('html,body').animate({
//             scrollTop: $(".positiontop").offset().top - $('.lightHeader').height()
//         }, 'slow');
//         if (step == 1) {
//             $(".progress-wizard-step").removeClass("complete");
//             $(".progress-wizard-step").removeClass("active");
//             $(".progress-wizard-step").removeClass("disabled");
//             $(".progress-step-1").addClass("active");
//             $(".progress-step-2").addClass("disabled");
//             $(".progress-step-3").addClass("disabled");
//             $(".progress-step-4").addClass("disabled");
//             $(".step1").slideDown();
//             $(".step2").slideUp();
//             $(".step3").slideUp();
//             $(".step4").slideUp();
//         } else if (step == 2) {
//             $(".progress-wizard-step").removeClass("complete");
//             $(".progress-wizard-step").removeClass("active");
//             $(".progress-wizard-step").removeClass("disabled");
//             $(".progress-step-1").addClass("complete");
//             $(".progress-step-2").addClass("active");
//             $(".progress-step-3").addClass("disabled");
//             $(".progress-step-4").addClass("disabled");
//             $(".step1").slideUp();
//             $(".step2").slideDown();
//             $(".step3").slideUp();
//             $(".step4").slideUp();
//         } else if (step == 3) {
//             $(".progress-wizard-step").removeClass("complete");
//             $(".progress-wizard-step").removeClass("active");
//             $(".progress-wizard-step").removeClass("disabled");
//             $(".progress-step-1").addClass("complete");
//             $(".progress-step-2").addClass("complete");
//             $(".progress-step-3").addClass("active");
//             $(".progress-step-4").addClass("disabled");
//             $(".step1").slideUp();
//             $(".step2").slideUp();
//             $(".step3").slideDown();
//             $(".step4").slideUp();
//         } else if (step == 4) {
//             $(".progress-wizard-step").removeClass("complete");
//             $(".progress-wizard-step").removeClass("active");
//             $(".progress-wizard-step").removeClass("disabled");
//             $(".progress-step-1").addClass("complete");
//             $(".progress-step-2").addClass("complete");
//             $(".progress-step-3").addClass("complete");
//             $(".progress-step-4").addClass("active");
//             $(".step1").slideUp();
//             $(".step2").slideUp();
//             $(".step3").slideUp();
//             $(".step4").slideDown();
//         } else if (step == 5) {
//             $(".progress-wizard-step").removeClass("complete");
//             $(".progress-wizard-step").removeClass("active");
//             $(".progress-wizard-step").removeClass("disabled");
//             $(".progress-step-1").addClass("complete");
//             $(".progress-step-2").addClass("complete");
//             $(".progress-step-3").addClass("complete");
//             $(".progress-step-4").addClass("complete");
//             $(".step1").slideUp();
//             $(".step2").slideUp();
//             $(".step3").slideUp();
//             $(".step4").slideDown();
//         }
//     };

//     $('.transaction input[type="radio"]').each(function () {
//         $(this).unbind('click');
//         $(this).click(function () {
//             var type = $(this).val();
//             checkTransaction(type);
//         });
//     });

//     var checkTransaction = function (type) {
//         var show = false;
//         $('.transaction input[type="radio"]').each(function () {
//             if ($(this).is(":checked")) {
//                 show = true;
//             }
//         });
//         if (show) {
//             $("#privacy").removeAttr('disabled');
//         } else {
//             $("#privacy").attr('disabled', 'disabled');
//         }
//     };

//     $("#privacy").unbind('click');
//     $("#privacy").click(function () {
//         checkPrivacy();
//     });

//     var checkPrivacy = function () {
//         if ($("#privacy").is(":checked")) {
//             $("#confirm-button").removeAttr('disabled');
//         } else {
//             $("#confirm-button").attr('disabled', 'disabled');
//         }
//     };
//     $("#confirm-button").unbind('click');
//     $("#confirm-button").click(function (e) {
//         e.preventDefault();
//         var culture = $(this).attr('data-culture');
//         var checkFullname = $("#customername").val().trim();
//         var checkPhone = $("#phone").val().trim();
//         var checkEmail = $("#email").val().trim();
//         if (checkFullname == '') {
//             $("#customername").focus();
//             if (culture == "vi") {
//                 Alert.Warning("Xin vui lòng điền tên của bạn.");
//             } else {
//                 Alert.Warning("Please fill your name.");
//             }
//             return false;
//         }
//         if (checkPhone == '') {
//             $("#phone").focus();
//             if (culture == "vi") {
//                 Alert.Warning("Xin vui lòng điền số điện thoại của bạn.");
//             } else {
//                 Alert.Warning("Please fill your phone.");
//             }
//             return false;
//         }
//         if (checkEmail == '') {
//             $("#email").focus();
//             if (culture == "vi") {
//                 Alert.Warning("Xin vui lòng điền email của bạn.");
//             } else {
//                 Alert.Warning("please fill your email");
//             }
//             return false;
//         }
//         var customername = $("#customername").val().trim();
//         var phone = $("#phone").val().trim();
//         var email = $("#email").val().trim();
//         var address = $("#address").val().trim();
//         var paymenttype = $("input[type='radio'][name='paymenttype']:checked").val();

//         document.getElementById("customername_hd").value = customername;
//         document.getElementById("phone_hd").value = phone;
//         document.getElementById("email_hd").value = email;
//         document.getElementById("address_hd").value = address;
//         document.getElementById("price_hd").value = bill['price'];
//         document.getElementById("quantity_hd").value = bill['quantity'];
//         document.getElementById("date_hd").value = bill['date'];
//         document.getElementById("paymenttype_hd").value = paymenttype;
//         document.getElementById("address_hd").value = address;
//         document.getElementById("shift_hd").value = bill['data_chuyen'];
//         document.getElementById("shift_id_hd").value = bill['id'];
//         document.getElementById("starttime_hd").value = bill['starttime'];
//         document.getElementById("destination_hd").value = bill['des_name'];
//         document.getElementById("departure_hd").value = bill['dep_name'];
        
//         document.getElementById("customername_tb").innerHTML = customername;
//         document.getElementById("phone_tb").innerHTML = phone;
//         document.getElementById("email_tb").innerHTML = email;
//         document.getElementById("address_tb").innerHTML = address;
//         document.getElementById("de_des").innerHTML = bill['dep_name'] + "-" + bill['des_name'];
//         document.getElementById("price_tb").innerHTML = bill['price'];
//         document.getElementById("quantity_tb").innerHTML = bill['quantity'];
//         document.getElementById("total_tb").innerHTML = bill['price']*bill['quantity'];
//         document.getElementById("chuyen_tb").innerHTML = bill['data_chuyen'];
//         document.getElementById("date_tb").innerHTML = bill['starttime'] + ' ' + bill['date'];
//         if(paymenttype == 1){
//             document.getElementById("paymenttype_tb").innerHTML = "giao dịch trực tiếp";
//         }
//         data_email = {customername: customername, phone: phone, email:email, address:address};
//         sendConfirmCodeText(data_email);
//         // gotostep(3);
//         return false;
//     });
//     $("#btnSendCodeAgain").unbind('click');
//     $("#btnSendCodeAgain").click(function(e){
//         e.preventDefault();
//         sendConfirmCodeText(data_email);
//     });
//     $.ajaxSetup({
//   headers: {
//     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });
//     function sendConfirmCodeText(data) {
//         document.getElementById('pageLoading').classList.toggle("show");
//       $.ajax({
//         type:'POST',
//         url: 'sendConfirmCodeText',
//         dataType: "json",
//         data: {customername: data.customername, phone: data.phone, email: data.email,
//           address: data.address, send_again: data.send_again},
//           success:function(data){
//             if(data.success === true){
//                 document.getElementById('pageLoading').classList.toggle("show");
//                 code = data.confirm_code_text;
//                 alert(code);
//                 gotostep(3);
//           }
//       },
//       error: function (data, textStatus, errorThrown) {
//         document.getElementById('pageLoading').classList.toggle("show");
//         var response = JSON.parse(data.responseText);
//         console.log(data);
//         displayError(response.errors);
//       },
//   });
//   }
//   function displayError(errors) {
//   // var errors = data.responseJSON.errors;
//   var firstItem = Object.keys(errors)[0];
//   var firstItemDOM = document.getElementById(firstItem);
//   var firstErrorMessage = errors[firstItem][0];

//           // scroll to te error message
//           firstItemDOM.scrollIntoView({behavior: "smooth", inline: "nearest"});
          
//           // remove all error messages
//           clearErrorText();
//           // // show error message
//           firstItemDOM.insertAdjacentHTML('afterend', `<p class="text-danger" style="font-size: 13px; margin:0;">* ${firstErrorMessage}</div>`)

//           // remove all form controls with highlighted error text box
//           clearBorderError();
//           // highlight the form control with the error 
//           firstItemDOM.classList.add('border', 'border-danger');
//         }

//         function clearErrorText(){
//           var errorMessages = document.querySelectorAll('.text-danger');
//           errorMessages.forEach((element)=>element.textContent = '');
//         }
//         function clearBorderError() {
//           var formControls = document.querySelectorAll('.form-control')
//           formControls.forEach((element)=> element.classList.remove('border', 'border-danger'));
//         }
