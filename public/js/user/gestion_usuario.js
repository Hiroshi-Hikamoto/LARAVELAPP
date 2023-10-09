let dataToken = $('meta[name="csrf-token"]').attr('content');
let slcchange = 0;
function AbrirModal(id){
    var ido = id;
    console.log(ido);
    $("#mediumModal").modal("show");
    let slcchange = 0;
};

function CrearUsuario(){
    var slcchange = document.getElementById("Cedula").value;

    if(slcchange == ''){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe ingresar el numero de cedula!',
            footer: ''
          })
     }else{
         //if(validacion){
            $.ajax({
                url: ('CrearUsuario'),
                type:'POST',
                data: {_token:dataToken, id:slcchange},
                success: function(data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Gracias...',
                        text: 'Usuario creado!',
                        confirmButtonText: 'Ok',
                        footer: ''
                      }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    })

                }
            });
        // }
        
     }

};

function cambiarFoto(){
    document.getElementById('archivo').click();
};

var outImage ="fotoPerfil";
function preview_2(obj)
{
	if (FileReader)
	{
		var reader = new FileReader();
		reader.readAsDataURL(obj.files[0]);
		reader.onload = function (e) {
		var image=new Image();
		image.src=e.target.result;
		image.onload = function () {
			document.getElementById(outImage).src=image.src;
		};
		}
	}
	else
	{
		    // Not supported
	}
}