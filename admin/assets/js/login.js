//localStorage.setItem("lastname", "Smith");
//alert(localStorage.getItem("authToken"));

$(document).ready(function() {
    //alert(localStorage.getItem("lastname"));
    $("#submit").click(function() {
        $("#loginError").html('');
        var uname = $("#username").val();
        var pass = $("#password").val();

        //alert(uname + " " + pass);

        if (uname == "") {
            $("#loginError").html('\
            <div class="alert alert-info alert-dismissible">\
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Enter Username.\
            ');
        } else if (pass == "") {
            $("#loginError").html('\
            <div class="alert alert-info alert-dismissible">\
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Enter Password.\
            ');
        } else {
            var data = new FormData();
            data.append("auth", "basic");
            data.append("username", uname);
            data.append("password", pass);

            $.ajax({
                method: "post",
                url: apiUrl + "login.php",
                data: data,
                processData: false,
                contentType: false,
                success: function(result) {
                    var obj = JSON.parse(result);
                    if (obj.responseCode == "000") {
                        //alert(obj.authToken);
                        localStorage.setItem("authToken", obj.authToken);
                        window.location.assign("index.html");
                    } else if (obj.responseCode == "010") {
                        $("#loginError").html('\
                            <div class="alert alert-info alert-dismissible">\
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Incorrect username or password.\
                        ');
                    } else {
                        $("#loginError").html('\
                            <div class="alert alert-info alert-dismissible">\
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> Something went wrong.\
                        ');
                    }
                }
            });
        }

    });

});