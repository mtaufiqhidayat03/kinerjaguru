"use strict";
var KTLoginGeneral = function () {
    var t = "",
        i = function (t, i, e) {
            var n = $('<div class="kt-alert kt-alert--outline alert alert-' + i + ' alert-dismissible" role="alert">\t\t\t<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\t\t\t<span></span>\t\t</div>');
            t.find(".alert").remove(), n.prependTo(t), KTUtil.animateClass(n[0], "fadeIn animated"), n.find("span").html(e)
        },
        e = function () {
        },
        n = function () {
        };
    return {
        init: function () {
            n(), $("#kt_login_signin_submit").click(function (t) {
                t.preventDefault();
                var e = $(this),
                    n = $(this).closest("form");
                n.validate({}), n.valid() && (e.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), n.ajaxSubmit({
                    url: "login/aksi_login",
                    success: function (t, s, r, a) {
                        console.log(r.responseText);
                        if (r.responseText === "" ) {
                            setTimeout(function () {
                            e.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i(n, "success", "Selamat, anda berhasil masuk sistem.")
                        }, 5e2)
                            setTimeout(function(){ window.location = "home"; }, 3000);

                        } else {
                        setTimeout(function () {
                            e.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), i(n, "danger", "Username dan/atau password anda salah. Silahkan coba lagi")
                        }, 5e2)
                        }
                    }
                }))
            }), $("#kt_login_signup_submit").click(function (n) {
                n.preventDefault();
                var s = $(this),
                    r = $(this).closest("form");
                r.validate({
                    rules: {
                        fullname: {
                            required: !0
                        },
                        email: {
                            required: !0,
                            email: !0
                        },
                        password: {
                            required: !0
                        },
                        rpassword: {
                            required: !0
                        },
                        agree: {
                            required: !0
                        }
                    }
                }), r.valid() && (s.addClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !0), r.ajaxSubmit({
                    url: "aksi_login",
                    success: function (n, a, l, o) {
                        setTimeout(function () {
                            s.removeClass("kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--light").attr("disabled", !1), r.clearForm(), r.validate().resetForm(), e();
                            var n = t.find(".kt-login__signin form");
                            n.clearForm(), n.validate().resetForm(), i(n, "success", "Thank you. To complete your registration please check your email.")
                        }, 2e3)
                    }
                }))
            })
        }
    }
}();
jQuery(document).ready(function () {
    KTLoginGeneral.init()
});
