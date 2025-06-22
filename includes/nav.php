
<div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__close">+</div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__auth mt-5">
            <a href="#">Login</a>
            <a href="#">Register</a>
        </div>
    </div>

<header class="header pst-stcky fix-t">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a class="cursor w-10 w-md-30" onclick="contenido('indexNS')"><img src="images/logo.png" width="100%"></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="nav-item nav-item-indexNS"><a class="cursor" onclick="contenido('indexNS')">Inicio</a></li>
                        <li class="nav-item my-lg-0 my-3 nav-item-shop"><a class="cursor" onclick="contenido('shop')">Tienda</a></li>
                        <!-- <li class="nav-item nav-item-"><a class="cursor" onclick="">Pages</a>
                            <ul class="dropdown">
                                <li><a class="cursor" onclick="">Product Details</a></li>
                                <li><a class="cursor" onclick="">Shop Cart</a></li>
                                <li><a class="cursor" onclick="">Checkout</a></li>
                                <li><a class="cursor" onclick="">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a class="cursor" onclick="">Blog</a></li> -->
                        <li class="nav-item nav-item-contacto"><a class="cursor" onclick="contenido('contacto')">Contacto</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <?php 
                    if($_SESSION['id_user']){
                        $idUserSession=$_SESSION['id_user'];
                ?>
                        <div class="header__right">
                            <ul class="header__right__widget">
                                <li><i class="fa fa-search"></i></li>
                                <li><a class="cursor" onclick=""><i class="fa fa-heart"></i>
                                    <div class="tip">2</div>
                                </a></li>
                                <li><a class="cursor" onclick=""><i class="fa fa-shopping-cart"></i>
                                    <div class="tip" id="cantCart">0</div>
                                </a></li>
                            </ul>
                        </div>
                <?php }else{ ?>
                        <div class="header__right">
                            <div class="header__right__auth">
                                <a class="cursor" data-toggle="modal" data-target="#exampleModalCenter">Iniciar Sesión</a>
                                <!-- <a class="cursor" onclick="">Restrarse</a> -->
                            </div>
                        </div>
                <?php } ?>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>

    
</header>
    