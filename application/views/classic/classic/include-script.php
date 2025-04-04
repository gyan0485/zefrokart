<!-- IziModal -->

<script src="<?= THEME_ASSETS_URL . 'js/eshop-bundle-js.js' ?>"></script>

<!-- Firebase.js -->
<script src="<?= THEME_ASSETS_URL . 'js/firebase-app.js' ?>"></script>
<script src="<?= THEME_ASSETS_URL . 'js/firebase-auth.js' ?>"></script>

<script src="<?= base_url('firebase-config.js') ?>"></script>
<!-- Custom -->
<?php if ($this->session->flashdata('message')) { ?>
    <script>
        Toast.fire({
            icon: '<?= $this->session->flashdata('message_type'); ?>',
            title: "<?= $this->session->flashdata('message'); ?>"
        });
    </script>
<?php } ?>

<script>
document.addEventListener("DOMContentLoaded", function() {

    function sendOrVerifyOtp(mobile, otp = '') {
        return function(resolve, reject) {
            $.ajax({
                type: 'POST',
                async: false,
                url: base_url + (otp != '' ? 'auth/login_with_otp_verify' : 'auth/login_with_otp'),
                data: { mobile: mobile, otp: otp, [csrfName]: csrfHash },
                dataType: 'json',
                success: function (result) {
                    result = typeof result == "string" ? JSON.parse(result) : result;
                    csrfName = result['csrfName'];
                    csrfHash = result['csrfHash'];
                    if( !result['error'] || result['error'] == 'false' ) {
                        resolve(result);
                    } else {
                        reject(result);
                    }
                },
                error: function() {
                    reject();
                }
            });
        };
    }

    let screen = "login"; // login / otp
    let form_disabled = false;
    let form_error = "";

    let $form;

    // firebase confirmation instance to verify the otp and receving the device id from firebase
    let confirmationResultInstance;

    const ToastNew = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });

    function reRenderForm() {
        if( !$form || $form.length == 0 ) return;

        const $btn = $form.find("[type='submit']");
        const $fs = $form.find("#login_with_otp_set");
        const $phone = $form.find(".enter_phone_wrapper");
        const $otp = $form.find(".enter_otp_wrapper");
        const $resend_link = $form.find("a#resend-otp");
        const $reenter_phone_link = $form.find("a#reenter-phone");
        const $error_field = $form.find("#login-otp-error");

        if( screen == "login" ) {
            $phone.show();
            $otp.hide();
            $resend_link.hide();
            $reenter_phone_link.hide();
        }
        else if( screen == "otp" ) {
            $phone.hide();
            $otp.show();
            $reenter_phone_link.show();
            $resend_link.show();
        }

        if( form_error && form_error != "" ) {
            $error_field.text(form_error);
        }

        if( form_disabled ) {
            $fs.attr("disabled", true).css({ pointerEvents: "none" });
            $btn.attr("disabled", true).text("Please wait...");
        } else {
            $btn.removeAttr("disabled").text("Login");
            $fs.removeAttr("disabled").css({ pointerEvents: "auto" });
        }
    }

    function toggleForm(display = "enabled") {
        form_disabled = display != "enabled";
        reRenderForm();
    }

    function triggerError(error = '') {
        let title = error != "" ? error : "Something is not right. Please refresh your page and try again.";
        ToastNew.fire({ icon: "error", title: title });
    }

    $(document).on("click", "a#resend-otp", function(e) {
        e.preventDefault();

        var form = $form = $("form#login_with_otp_form");

        screen = "login";

        form.find("input[name='otp']").val("");
        form.submit();
    });

    $(document).on("click", "a#reenter-phone", function(e) {
        e.preventDefault();

        var form = $form = $("form#login_with_otp_form");
        form.find("input[name='mobile_number']").val("");
        form.find("input[name='otp']").val("");

        form_disabled = false;
        screen = "login";
        reRenderForm();
    });

    $(document).on("submit", "form#login_with_otp_form", function(e) {
        e.preventDefault();

        if(form_disabled) return triggerError();

        var $self = $form = $(this);

        var phoneNumber = $self.find("input[name='mobile_number']").first().val().trim();
        var otp = $self.find("input[name='otp']").first().val().trim();
        var dialCode = $(".selected-dial-code").text().trim();

        if( !/^[0-9]{6,12}$/.test(phoneNumber) ) {
            return triggerError("Please enter a valid phone number and try again");
        }

        if( screen == "otp" ) {
            if( !otp || !/^[0-9]{3,8}$/.test(otp) ) {
                return triggerError("Invalid OTP. Please enter valid OTP or try resend");
            }

            toggleForm("disabled");
            
            setTimeout(function() {
                sendOrVerifyOtp(phoneNumber, otp)(
                    function() {
                        ToastNew.fire({ icon: "success", title: "Successfully logged in!" });
                        window.location = base_url +'home';
                    },
                    function(result) {
                        if( typeof result !== "undefined" && result && result['message'] ) {
                            triggerError(result['message']);    
                        } else {
                            triggerError("Invalid otp. Please try again.");
                        }
                        toggleForm("enabled");
                    }
                );
            }, 0);

            return;
        }

        toggleForm("disabled");
        
        setTimeout(function() {
            sendOrVerifyOtp(phoneNumber)(
                function() {
                    ToastNew.fire({ icon: "success", title: "OTP sent successfully on your phone!" });
                    screen = "otp";
                    form_disabled = false;
                    reRenderForm();
                },
                function() {
                    console.error("Login with otp error - ", err);
                    triggerError("Please enter correct phone number or refresh page and try again.");
                    toggleForm("enabled");    
                }
            );
        }, 0);
    });
});
</script>

<!-- Dark mode -->
<script src="<?= THEME_ASSETS_URL . 'js/darkmode-min.js' ?>"></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P6PMKJFH');</script>
<!-- End Google Tag Manager -->

<!--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8272928978285449"-->
<!--     crossorigin="anonymous"></script>-->
     
<!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-583712482"></script>-->
<!--<script>-->
<!--  window.dataLayer = window.dataLayer || [];-->
<!--  function gtag(){dataLayer.push(arguments);}-->
<!--  gtag('js', new Date());-->

<!--  gtag('config', 'AW-583712482');-->
<!--</script>-->

<!-- Google tag (gtag.js) -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-489ZPP7H5B"></script>-->
<!--<script>-->
<!--  window.dataLayer = window.dataLayer || [];-->
<!--  function gtag(){dataLayer.push(arguments);}-->
<!--  gtag('js', new Date());-->

<!--  gtag('config', 'G-489ZPP7H5B');-->
<!--</script>-->




<!-- Event snippet for Website sale conversion page -->
<!--<script>-->
<!--  gtag('event', 'conversion', {-->
<!--      'send_to': 'AW-583712482/sTMZCMOJgOQDEOL9qpYC',-->
<!--      'transaction_id': 'zefrokart'-->
<!--  });-->
<!--</script>-->


     
<script> $('.select-city').select2({
  placeholder: ''
}); </script>
