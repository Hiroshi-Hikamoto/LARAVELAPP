let dataToken = $('meta[name="csrf-token"]').attr('content');
var listen = 0;

$(document).ready(function(){
  $("flexSwitchCheckDefault").click(function(){
    alert("The paragraph was clicked.");
  });
});


function marcarNumero(letra,num) {
      var numero = document.getElementById(letra + num);
      //  console.log(numero)//background: lightblue;
       let balota = numero.innerText;
       var id_bingo = document.getElementById('id_bingo').value;
       let juego = document.getElementById('tipo_juego').value;
      if (numero.style.background == 'rgb(101, 230, 163)'){        
        $.ajax({
          url: ('/AVA/public/listenBingo'),
          type:'post',
          data: {_token:dataToken, id_bingo:id_bingo, juego:juego, numero: balota, tipo:4},
          success: function(data) {
            numero.style.background ='initial';
            numero.style.fontWeight = 'initial'
          }
          
        });

      }
      else{

        $.ajax({
          url: ('/AVA/public/listenBingo'),
          type:'post',
          data: {_token:dataToken, id_bingo:id_bingo, juego:juego, numero: balota, tipo:3},
          success: function(data) {
            numero.style.background = '#65E6A3';
            console.log(balota);
            // numero.style.backgroundImage = "url('http://avapp.digital:88/AVA/public/images/arroyave/AVAPP2-02.png')"
            numero.style.fontWeight = 'bold'
          }
          
        });
      }
      if (location.pathname == '/AVA/public/Adminbingo'){
        console.log(location.pathname)
        var c = escuchar();
      }
      
    }

    function limpiarTabla() {
        location.reload();
    }

    
    function bingoo(id) {
      console.log(id)
      $.ajax({
        url: ('/AVA/public/cantarBingo'),
        type:'POST',
        data: {_token:dataToken, id:id},
        success: function(data) {
          console.log(data)
          if (data == 'Ganador'){
            Swal.fire({
              icon: 'succes',
              title: 'Felicitaciones',
              text: 'Haz ganado en este bingo!',
              footer: ''
            })
          }else if(data == 'Aun no has ganado'){
            Swal.fire({
              icon: 'warning',
              title: 'Lo siento',
              text: 'Aun no has ganado falta alguno de los numeros de tu tabla!',
              footer: ''
            })
          }else if(data == 'Ya hay ganador'){
            Swal.fire({
              icon: 'warning',
              title: 'Se te adelantaron',
              text: 'Ya hay ganador alguin canto BINGO antes que tu!',
              footer: ''
            })
          }
                
        }
        
      });
      
  }
  
  function escuchar(e) {
    
    let id_bingo = document.getElementById('id_bingo').value;
    // console.log(e)
    let juego = document.getElementById('tipo_juego').value;
    
      const timeoutId = setInterval(function(){
        $.ajax({
          url: ('/AVA/public/listenBingo'),
          type:'post',
          data: {_token:dataToken, id_bingo:id_bingo, juego:juego, tipo:1},
          success: function(data) {
            if (data > 0){
              Swal.fire({
                  icon: 'success',
                  title: '¡GANADOR!',
                  text: 'Hay un feliz ganador de este bingo!',
                  footer: ''
                })
                clearTimeout(timeoutId);
            }
          }
          
        });
      }, 2000);
    
}
  
function ponerJugar(e) {
  let id_bingo = e;
  let juego = document.getElementById('tipo_juego').value;
  let combo = document.getElementById("tipo_juego");
  let NameJuego = combo.options[combo.selectedIndex].text;
  console.log(NameJuego)

  $.ajax({
    url: ('/AVA/public/jugar'),
    type:'post',
    data: {_token:dataToken, id_bingo:id_bingo, juego:juego},
    success: function(data) {
      if (data > 0){
        Swal.fire({
            icon: 'success',
            title: 'GRAN BINGO!',
            text: 'La partida ha iniciado en modo ' + NameJuego,
            footer: ''
          })
          escuchar(id_bingo)
      }
    }
    
  });
  
    // const timeoutId = setInterval(function(){
    //   $.ajax({
    //     url: ('/AVA/public/listenBingo'),
    //     type:'get',
    //     data: {_token:dataToken, id_bingo:id_bingo, juego:juego},
    //     success: function(data) {
    //       if (data > 0){
    //         Swal.fire({
    //             icon: 'success',
    //             title: '¡GANADOR!',
    //             text: 'Hay un feliz ganador de este bingo!',
    //             footer: ''
    //           })
    //           clearTimeout(timeoutId);
    //       }
    //     }
        
    //   });
    // }, 2000);
  
}