
// user profile script navbar
$("#user_profile_icon").on("click", function () {
    $("#user_profile").toggleClass("user-card");
    if ($("#user_profile").hasClass("user-card")) {
        $("#user_profile").hide();
    } else {
        $("#user_profile").show();
    }
});
// image preview for setting page
function showImg(img, previewId) {
    readInputURL1(img, previewId);
}

function readInputURL1(input, idName) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $("#" + idName)
                .attr("src", e.target.result)
                .width(80)
                .height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// show and hide password
$(".toggle-password").click(function () {
    $(this).toggleClass("fa-eye fa-eye-slash");
    input = $(this).parent().find("input");
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});