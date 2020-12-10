<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    $('#namencheck').hide();
    $('#apecheck').hide();
    $('#emailcheck').hide();
    $('#telefonocheck').hide();
    $('#direccioncheck').hide();





    let docuError = true;
    let userError = true;
    let nameError = true;
    let apeError = true;
    let emailError = true;
    let passwordError = true;
    let confirpasswordError = true;
    let rolworddError = true;




    function validateNames() {
        let usernameValue = $('#Nombres').val();
        $('#namencheck').hide();
        if (usernameValue.length == '') {
            $('#namencheck').show();
            nameError = false;
            return false;
        }
    }

    function validateTelefono() {
        let usernameValue = $('#telefono').val();
        $('#telefonocheck').hide();
        if (usernameValue.length == '') {
            $('#telefonocheck').show();
            docuError = false;
            return false;
        }
    }



    function validateApes() {
        let usernameValue = $('#Apellidos').val();
        $('#apecheck').hide();
        if (usernameValue.length == '') {
            $('#apecheck').show();
            apeError = false;
            return false;
        }
    }

    function validateEmail() {
        let usernameValue = $('#email').val();
        $('#emailcheck').hide();
        if (usernameValue.length == '') {
            $('#emailcheck').show();
            emailError = false;
            return false;
        }
    }


    function validateDireccion() {
        let usernameValue = $('#direccion').val();
        $('#direccioncheck').hide();
        if (usernameValue.length == '') {
            $('#direccioncheck').show();
            emailError = false;
            return false;
        }
    }



    // Validate Email
    const email =
        document.getElementById('email');
    email.addEventListener('blur', () => {
        let regex =
            /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let s = email.value;
        if (regex.test(s)) {
            email.classList.remove(
                'is-invalid');
            emailError = true;
            $('#emailcheck').hide();
        } else {
            email.classList.add(
                'is-invalid');
            emailError = false;
            $('#emailcheck').show();
        }
    })





    $('#submitbtn').click(function() {

        validateNames();
        validateApes();
        validateEmail();
        validateTelefono();
        validateDireccion();










        if ((emailError == true) &&
            (docuError == true) &&
            (rolworddError == true) &&
            (confirpasswordError == true) &&
            (passwordError == true) &&
            (apeError == true) &&
            (nameError == true) &&
            (docuError == true)) {



            //e.preventDefault();

            var nombre = $('#Nombres').val();
            var apellido = $('#Apellidos').val();
            var email = $('#email').val();
            var telefono = $('#telefono').val();
            var direccion = $('#direccion').val();


            var iduser = $('#iduser').val();

            $.ajax({
                type: 'POST',
                @if($edit == 0)
                url: "{{route('usuarioscreate')}}",
                @endif

                @if($edit == 1)
                url: "{{route('usuariosedit')}}",
                @endif


                data: {
                    @if($edit == 1)
                    iduser: iduser,
                    @endif
                    nombre: nombre,
                    apellido: apellido,
                    telefono: telefono,
                    direccion: direccion,
                    email: email
                },
                success: function(data) {
                    $('#avisoexito').modal('show');

                    @if($edit == 0)

                    var nombre = $('#Nombres').val("");
                    var apellido = $('#Apellidos').val("");
                    var email = $('#email').val("");
                    var telefono = $('#telefono').val("");
                    var direccion = $('#direccion').val("");
                    @endif
                },
                error: function(data) {
                    $('#mensajeerror').modal('show');
                }
            });

            e.preventDefault();
            return false;
        } else {
            //alert("nofunciona");
            return false;
        }

    });




});
</script>