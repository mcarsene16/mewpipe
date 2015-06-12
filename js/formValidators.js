$(document).ready(function() {
//formulaire d'inscription
    $("#register-form").validate({
        //règles de validations s'établi sur les attributs "name des balises"
        rules: {
            "lastName": {
                "required": true
            },
            "firstName": {
                "required": true
            },
            "birthDate": {
                "required": true,
                "minDate": true
            },
            "foneNumber": {
                "required": true,
                "number": true,
            },
            "email": {
                "required": true,
                "email": true,
                "maxlength": 255
            }
        },
        //les messages d'erreurs selon chaque rule
        messages: {
            lastName: "Veuillez saisir votre nom",
            firstName: "Veuillez saisir votre prénom",
            birthDate: {
                required: "Veuillez indiquer la date souhaitée pour votre événement",
                minDate: "Date antérieure à la date du jour"
            },
            foneNumber: {
                required: "Veuillez entrer un numéro de téléphone",
                number: "Veuillez ne saisir que des chiffres"
            },
            email: {
                required: "Veuillez saisir votre adresse mail",
                email: "Format incorrect de l'adresse mail"
            }
        }
    });
    $.validator.addMethod("maxDate", function(value, element) {
        var curDate = new Date();
        var inputDate = new Date(value);
        if (inputDate > curDate) {
            return false;
        }
        return true;
    }, "Invalid Date!");
    $(function() {
        $("#birthDate").datepicker({
            //dateFormat: 'dd/mm/yy'
        }).datepicker("setDate", new Date());
    });

    $('#deleteAccount').on("click", function() {
        deleteAccount();
    });

    function deleteAccount() {
        $.ajax({
            type: 'POST',
            url: './scripts/delete_account.php',
            data: "message=deleteAccount",
            dataType: 'text',
            success: redirect,
            error: function() {
                alert('Erreur serveur');
            }
        });
    }

    function redirect(reponse) {
        alert('Votre compte ainsi que vos fichiers personnels ont été supprimés');
        document.location.href = "logout";

    }
});