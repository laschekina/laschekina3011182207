$(document).ready(function () {

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    //-------- validation du formulaire de contact -----------//
    $('#form-user-contact').submit(function (e) {
        e.preventDefault()
    })

    $('#form-user-contact').parsley().on('form:validate', function (formInstance) {
        console.log(contactUrl);
        var l = Ladda.create(document.querySelector('.btnSendMessage'));
        l.start();
        if (formInstance.isValid()) {
            $.ajax({
                url: contactUrl,
                type: 'post',
                data: $('#form-user-contact').serialize()
            }).done(function (result) {
                l.stop();
                if (result.success === true) {
                    toastr["success"](result.message)
                    document.getElementById("form-user-contact").reset();
                } else {
                    toastr["error"]("Une erreur est survenue lors de l'envoi du message.")
                }
            }).fail(function () {
                toastr["error"]("Une erreur est survenue lors de l'envoi du message.")
                l.stop();
            })
                .always(function () {
                    l.stop();
                });
        }
    });
    //-------- fin validation formulaire de contact ----------//
})