function mostrarSaludo() {

    fecha = new Date();
    hora = fecha.getHours();

    if (hora >= 0 && hora < 5) {
        texto = "Ya es de madrugada";
        imagen = "../images/luna.png";
    }
    
    if (hora >= 5 && hora < 12) {
        texto = "Buenos Días";
        imagen = "../images/sol.png";
    }

    if (hora >= 12 && hora < 18) {
        texto = "Buenas Tardes";
        imagen = "../images/sol.png";
    }

    if (hora >= 18 && hora < 24) {
        texto = "Buenas Noches";
        imagen = "../images/luna.png";
    }
    

    document.images["tiempo"].src = imagen;

    document.getElementById('txtsaludo').innerHTML = texto;

    }