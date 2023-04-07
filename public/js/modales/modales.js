//scrip para ocultar modal
    window.livewire.on('ocultarModal', () => {
      $('#exampleModal').modal('hide');
    });

    //scrip para ocultar modal
    window.livewire.on('mensajes', (mensaje, mensajeDatos) => {
      $('#mensajes').modal('show');

      $('#welcome').text(mensaje);

       $('#user').text(mensajeDatos);
      //console.log(mensaje);
    //    // Crear una instancia de la síntesis de voz de Windows
    //   const voice = new ActiveXObject('Sapi.SpVoice');

    // // Reproducir el mensaje en voz alta
    //   voice.Speak(`${mensaje} ${mensajeDatos}`);
    });

    //mostrar modal para el update confirm 

    //scrip para ocultar modal
    window.livewire.on('MostrarModal', () => {
      $('#salidas').modal('show');
    });

    //scrip para ocultar modal
    window.livewire.on('concluido', () => {
      $('#salidas').modal('hide');
    });