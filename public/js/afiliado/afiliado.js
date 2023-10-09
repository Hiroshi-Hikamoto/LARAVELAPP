let slcchange = 0;
let dataToken = $('meta[name="csrf-token"]').attr('content');
function AbrirModal(id){
    var ido = id;
    console.log(ido);
    $("#num_id").val(ido);
    $("#mediumModal").modal("show");
    let slcchange = 0;
};


function AbrirModalVotacion(id){
    var ido = id;
    console.log(ido);
    $("#modalPtoVotacion").modal("show");
    let slcchange = 0;
};

function motivoSeleccionado(e){
    slcchange = e.value;

    if (slcchange == 5){
        var elemento = document.getElementById("campOtroMotivo");
                elemento.style.display = "block"
    }else{
        var elemento = document.getElementById("campOtroMotivo");
                elemento.style.display = "none"
    }
    console.log(e.value)
  };


 function Eliminar(id){
    var dataToken = $('meta[name="csrf-token"]').attr('content');
     valOtro = document.getElementById("otro").value;
     
     var validacion = false;
     if(slcchange == 0){
         console.log(dataToken);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe seleccionar un motivo!',
            footer: ''
          })
     }

     if(slcchange == 5 && valOtro == ''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Describa el motivo!',
            footer: ''
          })
     }else{
         //if(validacion){
            $.ajax({
                url: ('/eliminarAfiliado'),
                type:'POST',
                data: {_token:dataToken, id:id, motivo:slcchange,Otro:valOtro},
                success: function(data) {
                 // printMsg(data);
                }
            });
        // }
        
     }

 } 

 function departamentoSeleccionado(e){
    slcchangedpt = e.value;

    $("#town").empty();
    $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 1},function(response,state){
        for(i=0; i<response.length; i++){
            $("#town").append("<option value='"+response[i].Mpio+"'> "+response[i].municipio+"</option>" );
            $("#town").prop( "disabled", false );
        }
    })

  };

  function validarCedula(){
    var dataToken = $('meta[name="csrf-token"]').attr('content');
     valCedula = document.getElementById("cedula").value;
     valLider = document.getElementById("id_lider").value;
     console.log(valCedula);
     console.log(valLider);
    if (valCedula < 100000){
        Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Esto no parece una cedula!',
                footer: ''
            })
            return;
    }  
    else {
        $.get( "getMunicipios/1", { tipoAccion: 2, cedula: valCedula,idLider: valLider } )
        .done(function( response ) {
            console.log(response);
            console.log('Cantidad de registro: '+response.length);
            if (response == 1){
                  
                Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El usuario ya esta registrado!',
                            footer: ''
                          })    
                          document.getElementById("cedula").value = '';              
            }
            

        });
    }
     
 } 

 