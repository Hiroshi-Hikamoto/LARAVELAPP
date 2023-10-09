let dataToken = $('meta[name="csrf-token"]').attr('content');

function generarAudio(){
    let txt = document.getElementById('textAudio').value
    console.log(dataToken)

    $.ajax({
        url: ('toAuidio'),
        type:'get',
        data: {_token:dataToken, texto:txt},
        success: function(data) {
         
        }
        
      });
}