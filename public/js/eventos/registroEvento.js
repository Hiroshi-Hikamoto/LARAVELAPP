let dataToken = $('meta[name="csrf-token"]').attr('content');
var datos = [];
function validar(){
    
    var codigo = document.getElementById("codigo");
    console.log(codigo.value);
    $.ajax({
        url: ('/app/public/RegistraAsistencia'),
        type:'POST',
        data: {_token:dataToken, codigo:codigo.value},
        success: function(data) {
            codigo.value = '';
            if (data[0].conteo > 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El documento ya fue registrado!',
                    footer: ''
                  })
            }
            console.log(data);
            regis = document.getElementById("registrados");
            regis.innerHTML = data[0].registrados;
        }
        
    });

    codigo.value = '';
    codigo.focus();
    
    
}


function validarPreRegistro(){
    
    var cedula = document.getElementById("cedula");
    var evento = document.getElementById("id_evento");
    // console.log('este es el valor-' + evento.value + '-');

    if (evento.value == ""){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Seleccione primero el evento al que desea asistir!',
            footer: ''
          })
        cedula.value = '';
        // evento.value = '';
        evento.focus();
    }else{
        
    
        datos = [];
        $.ajax({
            url: ('/app/public/ValidarAfiliacion'),
            type:'GET',
            data: {_token:dataToken, cedula:cedula.value, evento:evento.value},
            success: function(data) {
                // codigo.value = '';
                // console.log(data.length); 
                    datos = data[0];
                if (data[0].resgistrado > 0){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La persona con esta identificacion ya fue registrada para este evento!',
                        footer: ''
                    })
                    cedula.value = '';
                    // evento.value = '';
                    evento.focus();
                }
                console.log(datos);
                // regis = document.getElementById("registrados");
                // regis.innerHTML = data[0].registrados;
            }
            
        });
    }

    
    
}

function validarGet(celular){
    

    var cel = celular.value;
    var nombre = document.getElementById("nombre");
    var direccion = document.getElementById("direccion");
    var correo = document.getElementById("correo");
    var fec_nacimiento = document.getElementById("fec_nacimiento");
    var referido = document.getElementById("referido");

    nombre.value = "";
    direccion.value = "";
    correo.value = "";
    fec_nacimiento.value = "";
    referido.value = "";

    if (datos.celular == cel){
        nombre.value = datos.Nom_Completo;
        direccion.value = datos.Direccion
        correo.value = datos.correo
        fec_nacimiento.value = datos.Fecha_Nacimiento
        referido.value = datos.lider
    }
    // console.log(datos.Nom_Completo);
}

function validarAsistencia(){
    var cedula = document.getElementById("cedula");
    var evento = document.getElementById("id_evento");
    if (cedula.value.length < 7){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Esto no parece una cedula o esta vacio!',
                footer: ''
            })
        }else{
            $.ajax({
                url: ('/app/public/validarAsistencia'),
                type:'post',
                data: {_token:dataToken, cedula:cedula.value, evento:evento.value, accion:1},
                success: function(data) {
                    if (data.length === 1){
                        datos = data[0];
                        if (data[0].confirmacion == 2){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'La persona ya confirmo la asistencia anteriormente!',
                                footer: ''
                            })
                            cedula.value = '';
                            cedula.focus;
                        }else{
                            Swal.fire({
                                title: 'Confirmar asistencia de ' + datos.Nombre_completo + '?',
                                // showDenyButton: true,
                                showCancelButton: true,
                                confirmButtonText: 'Si',
                                cancelButtonText: 'No',
                                // denyButtonText: `Don't save`,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    var cedula = document.getElementById("cedula");
                                    var evento = document.getElementById("id_evento");
                                    console.log(evento.value);
                                    $.ajax({
                                        url: ('/app/public/validarAsistencia'),
                                        type:'post',
                                        data: {_token:dataToken, cedula:cedula.value, evento:evento.value, accion:2},
                                        success: function(data) {
                                            if (data == 1){
                                                Swal.fire('Confirmado!', '', 'success');
                                                
                                                cedula.value = '';
                                                cedula.focus;
                                            }
                                        }
                                        
                                    });
                                }
                            })
                        }
                    }else{                        
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'La persona no se ha registrado para este evento!',
                            footer: ''
                        })

                    }
                    
                    console.log(datos);
                }
                
            });
        
    }
}

function verReporte(a){
    if (a == 1){
        // jQuery.noConflict(); 
        $('#mediumModal').modal("show");
        $('#mediumBody').html(result).show();
    }else if(a == 2){
        // jQuery.noConflict(); 
        $('#mediumModal').modal("hide");
    }
}