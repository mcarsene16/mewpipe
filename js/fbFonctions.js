window.fbAsyncInit = function() {
    FB.init({
        appId: '392937837577041',
        xfbml: true,
        version: 'v2.3',
        status: true,
        cookie: true
    });
    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;
            jQuery.ajax({
                async: true,
                type: "POST",
                url: ("scripts/facebook_login.php"),
                dataType: 'text',
                data: "uid=" + uid + "&accessToken=" + accessToken,
                success: function(data) {
                    console.log(data);
                    var reponse = data.split("|");
                    if (reponse[0] === "register") {
                        var names = reponse[1].split("-");
                        window.location.href = "register?lastName=" + names[0] + "&firstName=" + names[1];
                    }
                    if (reponse[0] === "user") {
                        window.location.href = "user";
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    //alert("error");
                }

            });
            //window.location.href = "user";
        }
        else {
            //window.location.href = "register";
        }

        if (response.authResponse) {
            //window.location.href = "register";
        }
        if (response.session) {


        } else {
            //window.location = "index.php"
        }

    });
};

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));