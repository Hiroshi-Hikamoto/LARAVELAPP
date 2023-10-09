let dataToken = $('meta[name="csrf-token"]').attr('content');

function selectDep(e){
    
    let idDepartameto = e.value;
    let idMunicipio = $("#municipio").val();
    $.ajax({
        url: ('/aie/public/selectList'),
        type:'get',
        data: {_token:dataToken, tipo:1, idDepartameto:idDepartameto},
        success: function(data) {
            $("#id_municipio").empty();
            for(i=0; i<data.length; i++){
                $("#id_municipio").append("<option value='"+data[i].Mpio+"'> "+data[i].municipio+"</option>" );
                $("#id_municipio").prop( "disabled", false );
            }
        }
    });
}

function selectMuni(e){
    
    let idDepartameto = $("#id_departamento").val();
    let idMunicipio = e.value;
    $.ajax({
        url: ('/aie/public/selectList'),
        type:'get',
        data: {_token:dataToken, tipo:2, idDepartameto:idDepartameto,idMunicipio:idMunicipio},
        success: function(data) {
            $("#id_mesa").empty();
            for(i=0; i<data.length; i++){
                $("#id_mesa").append("<option value='"+data[i].Zonacomuna+"'> "+data[i].Zonacomuna+"</option>" );
                $("#id_mesa").prop( "disabled", false );
            }
        }
    });
}

function selectZona(e){
    
    let idDepartameto = $("#id_departamento").val();
    let idMunicipio = $("#id_municipio").val();
    let idZona = e.value;
    $.ajax({
        url: ('/aie/public/selectList'),
        type:'get',
        data: {_token:dataToken, tipo:3, idDepartameto:idDepartameto,idMunicipio:idMunicipio,idZona:idZona},
        success: function(data) {
            $("#id_puesto").empty();
            for(i=0; i<data.length; i++){
                $("#id_puesto").append("<option value='"+data[i].Pto+"'> "+data[i].Puesto+"</option>" );
                $("#id_puesto").prop( "disabled", false );
            }
        }
        
    });
}

function getMesaVot(){
    
    let idDepartameto = $("#id_departamento").val();
    let idMunicipio = $("#id_municipio").val();
    let idZona = $("#id_mesa").val();
    let idPuesto = $("#id_puesto").val();
    $.ajax({
        url: ('/aie/public/getMesaVot'),
        type:'get',
        data: {_token:dataToken, tipo:3, idDepartameto:idDepartameto,idMunicipio:idMunicipio,idZona:idZona,idPuesto:idPuesto},
        success: function(data) {
            $("#tablaTestigos").empty().html(data.tabla);
        }
        
    });
}