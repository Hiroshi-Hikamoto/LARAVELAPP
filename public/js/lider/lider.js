function ValidarLider(Cedula){
    console.log(Cedula.value);
    var dataToken = $('meta[name="csrf-token"]').attr('content');
     valCedula = Cedula.value;
     
     document.getElementById("nom_completo").value = '';
     document.getElementById("Celular").value = '';

     $.get( "getLider/1", { tipoAccion: 2, cedula: valCedula } )
        .done(function( response ) {
            // console.log(response);
            // console.log('Cantidad de registro: '+response.length);
            if (response.length == 0 && valCedula !== ''){
                  
                Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El usuario no se encuentra registrado como afiliado!',
                            footer: ''
                          })    
                          document.getElementById("Cedula").value = '';              
            }else{
                console.log(response[0].Nombre_completo);
                var nombre = response[0].Nombre_completo;
                var celular = response[0].celular;
                document.getElementById("nom_completo").value = nombre;
                document.getElementById("Celular").value = celular;

            }
            

        });
}

function departamentoSeleccionado(e){
    slcchangedpt = e.value;
    var Municipio = $("#town").val();

    $("#town").empty();
    $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 1},function(response,state){
        for(i=0; i<response.length; i++){
            $("#town").append("<option value='"+response[i].Mpio+"'> "+response[i].municipio+"</option>" );
            $("#town").prop( "disabled", false );
        }
    })

    var Departamento = $("#state").val();
    var Municipio = 'null';

    $("#comuna").empty();
    $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 3,Departamento: Departamento,Municipio: Municipio},function(response,state){
        for(i=0; i<response.length; i++){
            $("#comuna").append("<option value='"+response[i].ZonaComuna+"'> "+response[i].ZonaComuna+"</option>" );
            $("#comuna").prop( "disabled", false );
        }
    })
    
    var ZonaComuna = 'null';

    $("#puestovota").empty();
    $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 4,Departamento: Departamento,Municipio: Municipio,ZonaComuna: ZonaComuna},function(response,state){
        for(i=0; i<response.length; i++){
            $("#puestovota").append("<option value='"+response[i].Id+"'> "+response[i].Puesto+"</option>" );
            $("#puestovota").prop( "disabled", false );
        }
    })

  };

  function municipioSeleccionado(e){
      slcchangedpt = e.value;
  
      var Departamento = $("#state").val();
      var Municipio = slcchangedpt;
  
      $("#comuna").empty();
      $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 3,Departamento: Departamento,Municipio: Municipio},function(response,state){
          for(i=0; i<response.length; i++){
              $("#comuna").append("<option value='"+response[i].ZonaComuna+"'> "+response[i].ZonaComuna+"</option>" );
              $("#comuna").prop( "disabled", false );
          }
      })
      
      var ZonaComuna = 'null';
  
      $("#puestovota").empty();
      $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 4,Departamento: Departamento,Municipio: Municipio,ZonaComuna: ZonaComuna},function(response,state){
          for(i=0; i<response.length; i++){
              $("#puestovota").append("<option value='"+response[i].Id+"'> "+response[i].Puesto+"</option>" );
              $("#puestovota").prop( "disabled", false );
          }
      })
  
    };

    function zonaComunaSeleccionado(e){
        slcchangedpt = e.value;
    
        var Departamento = $("#state").val();
        var Municipio = $("#town").val();
        var ZonaComuna = slcchangedpt;
    
        $("#puestovota").empty();
        $.get("getMunicipios/" + slcchangedpt+"",{tipoAccion: 4,Departamento: Departamento,Municipio: Municipio,ZonaComuna: ZonaComuna},function(response,state){
            for(i=0; i<response.length; i++){
                $("#puestovota").append("<option value='"+response[i].Id+"'> "+response[i].Puesto+"</option>" );
                $("#puestovota").prop( "disabled", false );
            }
        })
    
      };

      function mostrarFoto(){
        $("#myModal").modal("show");
      }