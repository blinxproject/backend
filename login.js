$(document).ready(function () {
  $("#loginForm").submit(function (e) {

    e.preventDefault();
   // alert('hi');
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
      type: "POST",
      url: "SignIn_function.php",
      data: {
        login: 1,
        username: username,
        password: password,
      },
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          window.location.href = response.redirect;
          console.log("Redirect URL:", response.redirect);
        } else {
          alert(response.message);
        }
      },
      error: function () {
        alert("Error in Ajax request");
      },
    });
  });
});
