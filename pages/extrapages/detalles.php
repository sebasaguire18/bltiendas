<?php

include '../../php/conexion-bd.php';

include '../../php/function.php';

error_reporting(0);

$tipo = $_POST['tipo'];

if ($tipo == 'producto') {
    $id = $_POST['id'];
    $consultaDatoDetalle=mysqli_query($conexion,"SELECT * FROM productos WHERE id = '$id'");

    while ($producto = mysqli_fetch_array($consultaDatoDetalle)) {

    ?>
        <!-- Breadcrumb -->
            <div class="breadcrumb-option">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb__links">
                                <a ><i class="fa fa-home"></i> Inicio</a>
                                <a >Tienda </a>
                                <span class="cursor" onclick="detalles(<?php echo $producto['id'];?>,'producto','contentPrincipalNoSession')"><?php echo $producto['nombre']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- Breadcrumb -->
        
        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="">
                            <?php if ($producto['img2']<>"") {
                                    if ($producto['img3']<>"") { ?>
                                        <div>
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img src="<?php echo $producto['img']; ?>" class="img-flex d-block" width="100%">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="<?php echo $producto['img2']; ?>" class="img-flex d-block" width="100%">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="<?php echo $producto['img3']; ?>" class="img-flex d-block" width="100%">
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon h1 text-black" aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon bi bi-chevron-right h1 text-black"  aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                                                    <span class="sr-only">Siguiente</span>
                                                </a>
                                            </div>
                                        </div>
                            <?php   }else { ?>
                                        <div>
                                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    <div class="carousel-item active">
                                                        <img src="<?php echo $producto['img']; ?>" class="img-flex d-block" width="100%">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img src="<?php echo $producto['img2']; ?>" class="img-flex d-block" width="100%">
                                                    </div>
                                                </div>
                                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon h1 txt-black" aria-hidden="true"><i class="fa fa-chevron-left"></i></span>
                                                    <span class="sr-only">Anterior</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon bi bi-chevron-right h1 txt-black"  aria-hidden="true"><i class="fa fa-chevron-right"></i></span>
                                                    <span class="sr-only">Siguiente</span>
                                                </a>
                                            </div>
                                        </div>
                            <?php   }
                            }else { ?>
                                <img src="<?php echo $producto['img']; ?>" class="img-flex d-block" width="100%">
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product__details__text">
                            <h3><?php echo $producto['nombre']; ?> <!--<span>Brand: SKMEIMore Men Watches from SKMEI</span>--></h3>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( <?php echo $producto['vistas']; ?> vistas )</span>
                            </div>
                            <?php if ($producto['descuento']>0) { ?>
                                <div class="product__details__price"><?php echo formatoAPrecio(calcularPrecioDescuento($producto['precio'],$producto['descuento'],0)); ?><span><?php echo formatoAPrecio($producto['precio']); ?></span></div>
                                <?php }else{ ?>
                                    <div class="product__details__price"><?php echo formatoAPrecio($producto['precio']); ?></div>
                            <?php } ?>
                            <p></p>
                            <div class="product__details__button">
                                <div class="quantity">
                                    <span>Cantidad:</span>
                                    <div class="pro-qty">
                                        <input type="text" id="cantidadProductoDet" value="1">
                                    </div>
                                </div>
                                <a onclick="insertarNuevoDato()" class="cart-btn cursor"><i class="fa fa-cart-plus"></i></a>
                                <ul class="dp-flex alg-itm-center jfy-ctn-center">
                                    <li><a class="cursor"><i class="fa fa-heart"></i></a></li>
                                    <!-- <li><a class="cursor"><span class="icon_adjust-horiz"></span></a></li> -->
                                </ul>
                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Disponibilidad:</span>
                                        <div class="stock__checkbox">
                                            <label for="stockin">
                                                En Stock
                                                <input type="checkbox" id="stockin" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Color disponible:</span>
                                        <div class="color__checkbox">
                                            <label for="red">
                                                <input type="radio" name="color__radio" id="red" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                            <label for="black">
                                                <input type="radio" name="color__radio" id="black">
                                                <span class="checkmark black-bg"></span>
                                            </label>
                                            <label for="grey">
                                                <input type="radio" name="color__radio" id="grey">
                                                <span class="checkmark grey-bg"></span>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Tamaño disponible:</span>
                                        <div class="size__btn">
                                            <label for="xs-btn" class="active">
                                                <input type="radio" id="xs-btn">
                                                Estandar
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <span>Promociones:</span>
                                        <p>Envio gratis.</p>
                                        <p> .</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Descripción</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <h6>Descripción</h6>
                                    <p><?php echo $producto['detalles']; ?></p>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <h6>Specification</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <h6>Reviews ( 2 )</h6>
                                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                        quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                        Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                        voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                        dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                        nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-details spad">
            <div class="container">
                <div class="row">
    <?php
                    consultarProdRel ($producto['categoria'],1);
    ?>
                </div>
            </div>
        </section>
    <?php
    }
}

?>