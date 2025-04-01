$(document).ready(function () {
  // contentNav('indexNS');
  contenido("indexNS");

  setInterval(() => {}, 1000);

  $(".ir-arriba").click(function () {
    $("body, html").animate(
      {
        scrollTop: "0px",
      },
      1000
    );
  });

  $(window).scroll(function () {
    if ($(this).scrollTop() > 0) {
      $(".ir-arriba").slideDown(1000);
    } else {
      $(".ir-arriba").slideUp(1000);
    }
  });

  // validacion de campos de email -- aqui el inicio de sesión y luego el de registrar
  let exprEmail = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-z0-9\-\.]+$/;

  let btnFormIS = $("#formInicioSesion");
  let FormIS = $("#btnIniciarSesion");

  btnFormIS.click(function () {
    FormIS.preventDefault();
    $("#usernameLoging", "#passLoging").removeClass("bd-danger");
    $("#spanUserLoging", "#spanPassLoging").addClass("d-none");

    // para el inicio de sesion desde el archivo index
    let usernameLoging = $("#usernameLoging").val();
    let passLoging = $("#passLoging").val();

    if (usernameLoging == "" || !exprEmail.test(usernameLoging)) {
      $("#usernameLoging").addClass("bd-danger");
      $("#spanUserLoging").removeClass("d-none");
      return false;
    } else {
      $("#usernameLoging").removeClass("bd-danger");
      $("#spanUserLoging").addClass("d-none");

      if (passLoging == "") {
        $("#passLoging").addClass("bd-danger");
        $("#spanPassLoging").removeClass("d-none");
        return false;
      } else {
        $("#passLoging").removeClass("bd-danger");
        $("#spanPassLoging").addClass("d-none");

        iniciarSesion(usernameLoging, passLoging);
      }
    }
  });

  $("#btnRegistrarCuenta").click(function () {
    // para el inicio de sesion desde el archivo index
    let name = $("#name").val();
    let usernameRegis = $("#usernameRegis").val();
    let passRegis = $("#passRegis").val();
    let pass2 = $("#pass2").val();

    if (name == "") {
      $("#name").addClass("dp-none");
      return false;
    } else {
      $("#name").removeClass("dp-none");

      if (usernameRegis == "" || !exprEmail.test(usernameRegis)) {
        $("#usernameRegis").addClass("dp-none");
        return false;
      } else {
        $("#usernameRegis").removeClass("dp-none");

        if (passRegis == "") {
          $("#passRegis").addClass("dp-none");
          return false;
        } else {
          $("#passRegis").removeClass("dp-none");
          if (pass2 == "") {
            $("#pass2").addClass("dp-none");
            return false;
          } else {
            $("#pass2").removeClass("dp-none");

            if (passRegis != pass2) {
              $("#textPassNoIgual").removeClass("d-none");
              return false;
            } else {
              $("#textPassNoIgual").addClass("d-none");
            }
          }
        }
      }
    }
  });

  /*------------------
        Preloader
    --------------------*/
  $(window).on("load", function () {
    $(".loader").fadeOut();
    $("#preloder").delay(200).fadeOut("slow");

    /*------------------
            Product filter
        --------------------*/
    $(".filter__controls li").on("click", function () {
      $(".filter__controls li").removeClass("active");
      $(this).addClass("active");
    });
    if ($(".property__gallery").length > 0) {
      var containerEl = document.querySelector(".property__gallery");
      var mixer = mixitup(containerEl);
    }
  });

  /*------------------
        Background Set
    --------------------*/
  $(".set-bg").each(function () {
    var bg = $(this).data("setbg");
    $(this).css("background-image", "url(" + bg + ")");
  });

  //Search Switch
  $(".search-switch").on("click", function () {
    $(".search-model").fadeIn(400);
  });

  $(".search-close-switch").on("click", function () {
    $(".search-model").fadeOut(400, function () {
      $("#search-input").val("");
    });
  });

  //Canvas Menu
  $(".canvas__open").on("click", function () {
    $(".offcanvas-menu-wrapper").addClass("active");
    $(".offcanvas-menu-overlay").addClass("active");
  });

  $(".offcanvas-menu-overlay, .offcanvas__close").on("click", function () {
    $(".offcanvas-menu-wrapper").removeClass("active");
    $(".offcanvas-menu-overlay").removeClass("active");
  });

  /*------------------
		Navigation
	--------------------*/
  $(".header__menu").slicknav({
    prependTo: "#mobile-menu-wrap",
    allowParentLinks: true,
  });

  /*------------------
        Accordin Active
    --------------------*/
  $(".collapse").on("shown.bs.collapse", function () {
    $(this).prev().addClass("active");
  });

  $(".collapse").on("hidden.bs.collapse", function () {
    $(this).prev().removeClass("active");
  });

  /*--------------------------
        Banner Slider
    ----------------------------*/
  $(".banner__slider").owlCarousel({
    loop: true,
    margin: 0,
    items: 1,
    dots: true,
    smartSpeed: 1200,
    autoHeight: false,
    autoplay: true,
  });

  /*--------------------------
        Product Details Slider
    ----------------------------*/
  $(".product__details__pic__slider")
    .owlCarousel({
      loop: false,
      margin: 0,
      items: 1,
      dots: false,
      nav: true,
      navText: [
        "<i class='arrow_carrot-left'></i>",
        "<i class='arrow_carrot-right'></i>",
      ],
      smartSpeed: 1200,
      autoHeight: false,
      autoplay: false,
      mouseDrag: false,
      startPosition: "URLHash",
    })
    .on("changed.owl.carousel", function (event) {
      var indexNum = event.item.index + 1;
      product_thumbs(indexNum);
    });

  function product_thumbs(num) {
    var thumbs = document.querySelectorAll(".product__thumb a");
    thumbs.forEach(function (e) {
      e.classList.remove("active");
      if (e.hash.split("-")[1] == num) {
        e.classList.add("active");
      }
    });
  }

  /*------------------
		Magnific
    --------------------*/
  $(".image-popup").magnificPopup({
    type: "image",
  });

  $(".nice-scroll").niceScroll({
    cursorborder: "",
    cursorcolor: "#dddddd",
    boxzoom: false,
    cursorwidth: 5,
    background: "rgba(0, 0, 0, 0.2)",
    cursorborderradius: 50,
    horizrailenabled: false,
  });

  /*------------------
        CountDown
    --------------------*/
  // For demo preview start
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, "0");
  var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  var yyyy = today.getFullYear();

  if (mm == 12) {
    mm = "01";
    yyyy = yyyy + 1;
  } else {
    mm = parseInt(mm) + 1;
    mm = String(mm).padStart(2, "0");
  }
  var timerdate = mm + "/" + dd + "/" + yyyy;
  // For demo preview end

  // Uncomment below and use your date //

  /* var timerdate = "2020/12/30" */

  $("#countdown-time").countdown(timerdate, function (event) {
    $(this).html(
      event.strftime(
        "<div class='countdown__item'><span>%D</span> <p>Day</p> </div>" +
          "<div class='countdown__item'><span>%H</span> <p>Hour</p> </div>" +
          "<div class='countdown__item'><span>%M</span> <p>Min</p> </div>" +
          "<div class='countdown__item'><span>%S</span> <p>Sec</p> </div>"
      )
    );
  });

  /*-------------------
		Range Slider
	--------------------- */
  var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data("min"),
    maxPrice = rangeSlider.data("max");
  rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
      minamount.val("$" + ui.values[0]);
      maxamount.val("$" + ui.values[1]);
    },
  });
  minamount.val("$" + rangeSlider.slider("values", 0));
  maxamount.val("$" + rangeSlider.slider("values", 1));

  /*------------------
		Single Product
	--------------------*/
  $(".product__thumb .pt").on("click", function () {
    var imgurl = $(this).data("imgbigurl");
    var bigImg = $(".product__big__img").attr("src");
    if (imgurl != bigImg) {
      $(".product__big__img").attr({ src: imgurl });
    }
  });

  /*-------------------
		Quantity change
	--------------------- */
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

  /*-------------------
		Radio Btn
	--------------------- */
  $(".size__btn label").on("click", function () {
    $(".size__btn label").removeClass("active");
    $(this).addClass("active");
  });
});
