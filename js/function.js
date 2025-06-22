// función que cambia el contenido principal de todas las pantallas recibiendo un string para saber que contendido llamar
function contenido(ventana, session = false) {
  if (session) {
    $("#contentPrincipal").html(``);

    $.ajax({
      type: "POST",
      url: "pages/" + ventana + ".php",
      data: "ventana=" + ventana,
      success: function (r) {
        configPage(ventana);
        $("#contentPrincipal").html(r);

        // cargar las imagenes que hayan en la página que se imprimio
        $(".set-bg").each(function () {
          var bg = $(this).data("setbg");
          $(this).css("background-image", "url(" + bg + ")");
        });
      },
    });
  } else {
    $("#contentPrincipalNoSession").html(``);

    $.ajax({
      type: "POST",
      url: "pages/" + ventana + ".php",
      data: "ventana=" + ventana,
      success: function (r) {
        configPage(ventana);
        $("#contentPrincipalNoSession").html(r);

        // cargar las imagenes que hayan en la página que se imprimio
        $(".set-bg").each(function () {
          var bg = $(this).data("setbg");
          $(this).css("background-image", "url(" + bg + ")");
        });
      },
    });
  }

  // otra forma
  // if (ventana == 'indexNS') {
  //     $.ajax({
  //         type: "POST",
  //         url: "pages/indexNS.php",
  //         data: "ventana=" + ventana,
  //         success: function(r) {
  //             configPage('indexNS');
  //             $('#contentPrincipalNoSession').html(r);
  //         }
  //     });
  // }
}

function filtroCat(ventana, categoria) {
  $("#contentPrincipalNoSession").html(``);
  $.ajax({
    type: "POST",
    url: "pages/" + ventana + ".php",
    data: "ventana=" + ventana + "&categoria=" + categoria,
    success: function (r) {
      configPage(ventana);
      $("#contentPrincipalNoSession").html(r);

      // cargar las imagenes que hayan en la página que se imprimio
      $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
      });
    },
  });
}

// función que da configuraciones extra al cargar el contenido de la vista
function configPage(page) {
  $(".nav-item").removeClass("active");
  $(".nav-item-" + page).addClass("active");
  if (page == "indexNS") {
    // contentNav('indexNS');
    $("#titlePageNS").html(`Inicio`);
  }
  if (page == "shop") {
    $("#titlePageNS").html(`Tienda`);
  }
  if (page == "shopFilter") {
    $("#titlePageNS").html(`Tienda`);
  }
  if (page == "detalle-producto") {
    $("#titlePageNS").html(`Detalles de Producto`);
  }
  if (page == "contacto") {
    $("#titlePageNS").html(`Contacto`);
  }
}

// función que carga la barra de navegación central
function contentNav(nav) {
  $("#contentNav").html(``);
  let q = "";
  $.ajax({
    type: "POST",
    url: "pages/nav.php",
    data: "nav=" + nav,
    success: function (r) {
      $("#contentNav").html(r);
      q = consultarCarritoCompras(consultaIdSession());
      $("#cantCart").html(q);
    },
  });
}

// función que carga la barra de navegación central
function consultarCarritoCompras() {
  $.ajax({
    type: "POST",
    url: "php/controler.php",
    data: "tipo=queryShoppingCart",
    success: function (r) {
      return r;
    },
  });
}

// función que carga la barra de navegación central
function consultaIdSession() {
  $.ajax({
    type: "POST",
    url: "php/controler.php",
    data: "tipo=consultarUserSession",
    success: function (r) {
      return r;
    },
  });
}

// función que optiene el contenido de tablas dependiendo de su id
function tablas(tabla) {
  if (tabla == "tblLista") {
    $.ajax({
      type: "POST",
      url: "pages/tablas.php",
      data: "tabla=" + tabla,
      success: function (r) {
        $("#tblContent").html(r);
        tblInit(tabla);
      },
    });
  }
}

// datatables
function tblInit(tabla) {
  $(function () {
    if (tabla == "tblLista") {
      // datatable de tabla contactos
      $("#tblLista").DataTable({
        language: {
          url: "extensions/datatables/Spanish.json",
        },
        responsive: "true",
        scrollCollapse: true,
        scrollX: true,
        dom: "lfBrtip",
        buttons: [
          {
            extend: "excelHtml5",
            text: '<span class="txt-white icon-file-excel"></span>',
            titleattr: "Exportar a Excel",
            className: "ruler-button_child bg-success",
          },
          {
            extend: "pdfHtml5",
            text: '<span class="txt-white icon-file-pdf"></span>',
            titleattr: "Exportar a Excel",
            className: "ruler-button_child bg-danger",
          },
          {
            extend: "print",
            text: '<span class="txt-white icon-printer"></span>',
            titleattr: "Exportar a Excel",
            className: "ruler-button_child bg-info",
          },
        ],
      });
    }
  });
}

// función que cambia de formularios para iniciar sesion, registrarse o recuperar contraseña
function changeForm(form) {
  if (form == "regis") {
    $("#box-sesion").addClass("dp-none");
    $("#box-regis").removeClass("dp-none");
  } else if (form == "ini") {
    $("#box-regis").addClass("dp-none");
    $("#box-sesion").removeClass("dp-none");
  }
  // else if (form == 'olv'){
  //     $('#').addClass('d-');
  //     $('#').removeClass('d-');
  // }
}

// Función para iniciar sesión
function iniciarSesion(usernameLoging, passLoging) {
  $("#btnIniciarSesion").text("Validando datos...");
  $("#usernameLoging", "#passLoging").removeClass("bd-danger");
  $("#spanUserLogingError").addClass("dp-none");
  $("#spanPassLogingError").addClass("dp-none");

  $.ajax({
    type: "POST",
    url: "php/iniciosesion.php",
    data: "usernameLoging=" + usernameLoging + "&passLoging=" + passLoging,
    success: function (r) {
      if (r == "errorPassword") {
        $("#passLoging").addClass("bd-danger");
        $("#spanPassLogingError").removeClass("dp-none");
        $("#btnIniciarSesion").text("Validar");
      }
      if (r == "errorUsername") {
        $("#usernameLoging").addClass("bd-danger");
        $("#spanUserLogingError").removeClass("dp-none");
        $("#btnIniciarSesion").text("Validar");
      }
      //   if (r == "successSesion") {
      //     window.location.href = "welcome.php";
      //   }
    },
  });
}

// Función que inserta un nuevo Dato
function insertarNuevoDato() {
  let tipo = "nuevoDato";

  let exprNumber = /^[0-9.]+$/;

  let cantidadProductoDet = $("#cantidadProductoDet").val();
  let idProductoDetalle = $("#idProductoDetalle").val();
  // let referenciaNuevoDato = $('#referenciaNuevoDato').val();

  // $('#nombreNuevoDato','#referenciaNuevoDato').removeClass('bd-danger');
  // $('#spanNombreNuevoDato','#spanReferenciaNuevoDato').addClass('dp-none');

  // if(nombreNuevoDato == ''){
  //     $('#nombreNuevoDato').addClass('bd-danger');
  //     $('#spanNombreNuevoDato').removeClass('dp-none');
  //     return false;
  // }else{
  //     $('#nombreNuevoDato').removeClass('bd-danger');
  //     $('#spanNombreNuevoDato').addClass('dp-none');

  //     // así se valida un campo que debería contener solo carácteres numericos
  //     if(precioNuevoDato == '' || !exprNumber.test(precioNuevoDato)){
  //         $('#precioNuevoDato').addClass('bd-danger');
  //         $('#spanPrecioNuevoDato').removeClass('dp-none');
  //         return false;
  //     }else{
  //         $('#precioNuevoDato').removeClass('bd-danger');
  //         $('#spanPrecioNuevoDato').addClass('dp-none');

  //         // En este punto ya con el formulario validado podemos enviar los datos al servidor.
  //         cerrarModal('ExampleModal');
  //         $.ajax({
  //             type: "POST",
  //             url: "php/controler.php",
  //             data: "tipo=" + tipo + "&nombreNuevoDato=" + nombreNuevoDato + "&referenciaNuevoDato=" + referenciaNuevoDato,
  //             success: function(r) {
  //                 if (r == 'success') {
  //                     sweetAlertType('success','welcome');
  //                     cerrarModal('ExampleModal');
  //                 }else if(r == 'error'){
  //                     sweetAlertType('error','welcome');
  //                 }else if(r == 'info'){
  //                     sweetAlertType('info','welcome');
  //                 }
  //             }
  //         });
  //     }
  // }

  alert(cantidadProductoDet + " id: " + idProductoDetalle);
}

// Función para iniciar sesión
function iniciarSesion() {
  let usernameLoging = $("#usernameLoging").val();
  let passLoging = $("#passLoging").val();

  let exprEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-z0-9\-\.]+$/;

  $("#spanUserLoging", "#spanPassLoging").addClass("d-none");
  $("#usernameLoging", "#passLoging").removeClass("border-danger");

  if (usernameLoging == "" || !exprEmail.test(usernameLoging)) {
    $("#usernameLoging").addClass("border-danger");
    $("#spanUserLoging").removeClass("d-none");
    return false;
  } else {
    $("#usernameLoging").removeClass("border-danger");
    $("#spanUserLoging").addClass("d-none");

    if (passLoging == "") {
      $("#passLoging").addClass("border-danger");
      $("#spanPassLoging").removeClass("d-none");
      return false;
    } else {
      $("#passLoging").removeClass("border-danger");
      $("#spanPassLoging").addClass("d-none");
    }

    $("#btnIniciarSesion").text("Validando datos...");
    $("#usernameLoging", "#passLoging").removeClass("border-danger");
    $("#spanUserLogingError").addClass("d-none");
    $("#spanPassLogingError").addClass("d-none");

    $.ajax({
      type: "POST",
      url: "php/iniciosesion.php",
      data: "usernameLoging=" + usernameLoging + "&passLoging=" + passLoging,
      success: function (r) {
        setTimeout(function () {
          if (r == "errorUsername") {
            $("#usernameLoging").addClass("border-danger");
            $("#spanUserLogingError").removeClass("d-none");
            $("#btnIniciarSesion").text("Validar");
          }
          if (r == "errorPassword") {
            $("#passLoging").addClass("border-danger");
            $("#spanPassLogingError").removeClass("d-none");
            $("#btnIniciarSesion").text("Validar");
          }

          if (r != "errorUsername" && r != "errorPassword") {
            window.location.href = "welcome.php";
          }
        }, 500);
      },
    });
  }
}

// Función para editar por id y tipo de edición
function editar(id, tipo) {
  if (tipo == "Dato") {
    $.ajax({
      type: "POST",
      url: "pages/extrapages/editar.php",
      data: "tipo=" + tipo + "&id=" + id,
      success: function (r) {
        $("#editarProdBody").html(r);
        abrirModal("ExampleModal");
      },
    });
  }
}

// Función para ver los detalles por id de algun tipo
function detalles(id, tipo, sesion) {
  if (tipo == "producto") {
    $.ajax({
      type: "POST",
      url: "pages/extrapages/detalles.php",
      data: "tipo=" + tipo + "&id=" + id,
      success: function (r) {
        $("body, html").animate(
          {
            scrollTop: "0px",
          },
          1000
        );
        configPage("detalle-" + tipo);
        $("#" + sesion).html(r);

        // cargar las imagenes que hayan en la página que se imprimio
        $(".set-bg").each(function () {
          var bg = $(this).data("setbg");
          $(this).css("background-image", "url(" + bg + ")");
        });

        // cambiar cantidad detalle producto

        var proQty = $(".pro-qty");
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on("click", ".qtybtn", function () {
          var $button = $(this);
          var oldValue = $button.parent().find("input").val();
          if ($button.hasClass("inc")) {
            var newVal = parseFloat(oldValue) + 1;
          } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
              var newVal = parseFloat(oldValue) - 1;
            } else {
              newVal = 0;
            }
          }
          $button.parent().find("input").val(newVal);

          
        });
      },
    });
  }
}

// Función para eliminar por id y tipo
function eliminar(id, tipo) {
  if (tipo == "dato") {
    sweetAlertType("eliminar", "datos", id);
  }
}

// Función para eliminar por id y tipo
function ConfirmEliminar(id, tipo) {
  if (tipo == "dato") {
    type = "eliminarDato";
    $.ajax({
      type: "POST",
      url: "php/controler.php",
      data: "tipo=" + type + "&idEliminar=" + id,
      success: function (r) {
        if (r == "success") {
          sweetAlertType("success", "welcome");
        } else if (r == "error") {
          sweetAlertType("error", "welcome");
        } else if (r == "info") {
          sweetAlertType("info", "welcome");
        }
      },
    });
  }
}

// Función para editar cada dato que se pueda, se debe de crar una función por cada parte o sección que desee editar
function editarDato(id) {
  let tipo = "editarDato";

  let exprNumber = /^[a-zA-Z0-9.]+$/;

  let nombreDatoE = $("#nombreDatoE").val();
  let referenciaDatoE = $("#referenciaDatoE").val();

  $("#nombreDatoE", "#referenciaDatoE").removeClass("bd-danger");
  $("#spanNombreDatoE", "#spanReferenciaDatoE").addClass("dp-none");

  if (nombreDatoE == "") {
    $("#nombreDatoE").addClass("bd-danger");
    $("#spanNombreDatoE").removeClass("dp-none");
    return false;
  } else {
    $("#nombreDatoE").removeClass("bd-danger");
    $("#spanNombreDatoE").addClass("dp-none");
    if (precioDatoE == "" || !exprNumber.test(precioDatoE)) {
      $("#precioDatoE").addClass("bd-danger");
      $("#spanPrecioDatoE").removeClass("dp-none");
      return false;
    } else {
      $("#precioDatoE").removeClass("bd-danger");
      $("#spanPrecioDatoE").addClass("dp-none");

      if (pesoDatoE == "" || !exprNumber.test(pesoDatoE)) {
        $("#pesoDatoE").addClass("bd-danger");
        $("#spanPesoDatoE").removeClass("dp-none");
        return false;
      } else {
        $("#pesoDatoE").removeClass("bd-danger");
        $("#spanPesoDatoE").addClass("dp-none");

        // En este punto ya con el formulario validado podemos enviar los datos al servidor.
        cerrarModal("editarProducto");
        $.ajax({
          type: "POST",
          url: "php/controler.php",
          data:
            "tipo=" +
            tipo +
            "&idProducto=" +
            id +
            "&nombreDatoE=" +
            nombreDatoE +
            "&referenciaDatoE=" +
            referenciaDatoE,
          success: function (r) {
            if (r == "success") {
              sweetAlertType("success", "welcome");
              cerrarModal("ExampleModal");
            } else if (r == "error") {
              sweetAlertType("error", "welcome");
            } else if (r == "info") {
              sweetAlertType("info", "welcome");
            }
          },
        });
      }
    }
  }
}

// Función que limpia formularios por id
function limpiarFormulario(nombre) {
  document.getElementById(nombre).reset();
}

// Función que convierte la primera letra de un string a mayúscula
function capitalizarPrimeraLetra(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

// sweetAlert
function sweetAlertType(type, page, id = false) {
  $(function () {
    if (type == "success") {
      Swal.fire({
        icon: "success",
        title: "Registrado correctamente",
      }).then(() => {
        contenido(page);
      });
    }
    if (type == "error") {
      Swal.fire({
        icon: "error",
        title: "El registro no se pudo realizar",
      });
    }
    if (type == "info") {
      Swal.fire({
        icon: "info",
        title: "Algunos campos obligatorios deben contener valores",
      });
    }
    if (type == "eliminado") {
      Swal.fire({
        icon: "success",
        title: "Eliminado correctamente",
      }).then(() => {
        contenido(page);
      });
    }
    if (type == "eliminar") {
      Swal.fire({
        title: "¿Estás seguro?",
        text: "¿Quieres eliminar el registro seleccionado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#198754",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
      }).then((result) => {
        if (result.isConfirmed) {
          ConfirmEliminar(id, page);
        }
      });
    }
  });
}

// Necesario para abrir cualquier modal
function abrirModal(idModal) {
  $(".overlay" + idModal).addClass("activeP");
  $("#" + idModal).addClass("activeP");
}

// Necesario para cerrar cualquier modal
function cerrarModal(idModal) {
  $(".overlay" + idModal).removeClass("activeP");
  $("#" + idModal).removeClass("activeP");
}
