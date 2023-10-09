let dataToken = $('meta[name="csrf-token"]').attr('content');
function AbrirModal(id){
    var ido = id;
    console.log(ido);
    $("#num_id").val(ido);
    $("#mediumModal").modal("show");
    let slcchange = 0;
};


function crearCampana(){
    let nomCampaña = document.getElementById("nombre_campaña").value;
    let idTipo = document.getElementById("idTipo");
    console.log(idTipo);
    // if(isEmpty(nomCampaña) || isEmpty(idTipo)){
    //     console.log("Debe completar toda la informacion")
    // }
}

function cargarArchivo(file){
            var babyGirl = "ni\u00f1a";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
            if (regex.test($("#fileUpload").val().toLowerCase())) {
                if (typeof (FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var table = $("<table class='table table-striped table-hover' />");
                        var rows = e.target.result.split("\n");
                        for (var i = 0; i < rows.length; i++) {
                            if (i == 0){
                                var row = $("<thead class='thead' /> <tr> </th>");
                                var cells = rows[i].split(";");
                                for (var j = 0; j < cells.length; j++) {
                                    var cell = $("<td />");
                                    cell.html(cells[j]);
                                    row.append(cell);
                                }
                            }else{
                                var row = $("<tr />");
                                var cells = rows[i].split(";");
                                for (var j = 0; j < cells.length; j++) {
                                    var cell = $("<td />");
                                    cell.html(cells[j]);
                                    row.append(cell);
                                }
                            }
                            table.append(row);
                        }
                        $("#dvCSV").html('');
                        $("#dvCSV").append(table);
                    }
                    reader.readAsText($("#fileUpload")[0].files[0]);
                } else {
                    alert("This browser does not support HTML5.");
                }
            } else {
                alert("Please upload a valid CSV file.");
            }
    console.log(file)
    // $.ajax({
    //     url: ('/AVA/public/cargarArchivo'),
    //     type:'POST',
    //     data: {_token:dataToken, codigo:1},
    //     success: function(data) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: 'El documento ya fue registrado!',
    //                 footer: ''
    //               })
    //     }
        
    //   });
}

function upload(){
    let file = $("#fileUpload").val();
    console.log(file)
    // $.ajax({
    //     url: ('/AVA/public/cargarArchivov'),
    //     type:'POST',
    //     data: {_token:dataToken, codigo:1},
    //     success: function(data) {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Oops...',
    //                 text: 'El documento ya fue registrado!',
    //                 footer: ''
    //               })
    //     }
        
    //   });
}