$(document).ready(function() {
      // Obtener la URL actual y eliminar el nombre del dominio
      var url = window.location.pathname;

      // Iterar a través de los elementos de la lista de navegación
      $(".nav-item a").each(function() {
        var link = $(this).attr('href');

        // Verificar si la URL actual coincide con el enlace del elemento de la lista de navegación
        if (url == link) {
          $(this).addClass('active'); // agregar clase "active" al elemento "a"
          $(this).parents('.has-treeview').addClass('menu-open'); // agregar clase "menu-open" al elemento padre "li"
          localStorage.setItem('activeLink', link); // almacenar el enlace activo en el almacenamiento local
        }
      });

      // Agregar evento de clic a los elementos de enlace
      $(".nav-item a").click(function() {
        localStorage.setItem('activeLink', $(this).attr('href')); // almacenar el enlace activo en el almacenamiento local
      });

      // Obtener el enlace activo del almacenamiento local y agregar la clase "active"
      var activeLink = localStorage.getItem('activeLink');
      if (activeLink) {
        $(".nav-item a[href='" + activeLink + "']").addClass('active');
        $(".nav-item a[href='" + activeLink + "']").parents('.has-treeview').addClass('menu-open');
      }
    });