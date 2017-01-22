
$(function() {
    console.log( "ready!" );
});

function bindEvents(){
  $("#btn_login").click(function(e){
      e.stopPropagation();
      e.preventDefault();
      loginAjax();
  });
}

function loginAjax(){
  $.ajax({
        url: base_url()+"/Ajax_controller/login_control",
        type: 'POST',
        data: {
            user: $("#name").val(),
            pass: $("#password").val();
        },
        dataType: 'json',
        success: function(data) {
            console.log(data);
        }
    });
}
