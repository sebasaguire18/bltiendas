<?php 

// dar formato a una fecha, sí se le pasa el segundo parametro regresa la fecha con la hora

function formatoAFecha($fecha,$hora=false){
        
    date_default_timezone_set('America/Bogota');

    if ($hora) {
        $mes = array("","Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre");

        $fechaCF=date('d',strtotime($fecha)) . " de " . $mes[date('n',strtotime($fecha))] . " de " . date('Y',strtotime($fecha)) . " a las " . date('g:i a',strtotime($fecha));

        return $fechaCF;
        
    }else {
        $mes = array("","Enero",
                    "Febrero",
                    "Marzo",
                    "Abril",
                    "Mayo",
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre");

        $fechaCF=date('d',strtotime($fecha))." de ". $mes[date('n',strtotime($fecha))] . " de " . date('Y',strtotime($fecha));

        return $fechaCF;
    }
}

// dar formato a un precio COP

function formatoAPrecio($precio){
        
    $precioCF='$ '.number_format($precio,0,",",".");

    return $precioCF;
}

// calcular el precio con descuento segun el porcentaje y precio base

function calcularPrecioDescuento($precioBase,$descuento,$formato){
    
    include '../php/conexion-bd.php';
    if ($formato==0) {
        $precioFinal = ($descuento * $precioBase) / 100 ;
        $precioFinal = $precioBase - $precioFinal ;
    }else {
        $precioFinal = ($descuento * $precioBase) / 100 ;
        $precioFinal = $precioBase - $precioFinal ;
        $precioFinal = number_format($precioFinal,0,",",".") ;
    }

    return $precioFinal;
}

// crear select

function selectDatos($status=false){
    include 'conexion-bd.php';

    if ($status) {
        $seleccionarDatos = mysqli_query($conexion," SELECT * FROM datbla WHERE tabla_status = $status ");
    }else {
        $seleccionarDatos = mysqli_query($conexion," SELECT * FROM datbla WHERE tabla_status = 1");
    }
    ?>
            <option value="0" selected>Datos</option>
    <?php
        while ($datos = mysqli_fetch_array($seleccionarDatos)) {
    ?>
            <option value="<?php echo $datos['datos_id'] ?>"><?php echo $datos['datos_nombre']?></option>
    <?php 
        }
    
}

// consultar productos para listarlos en la page de shop.php

function consultarProd($status, $idProd = false){
    include 'conexion-bd.php';

    if ($idProd) {
        $consultarDatosProd = mysqli_query($conexion," SELECT * FROM productos WHERE status = $status AND id = '$idProd' ");
    }else {
        $consultarDatosProd = mysqli_query($conexion," SELECT * FROM productos WHERE status = $status");
    }
    ?>
    <?php
        while ($producto = mysqli_fetch_array($consultarDatosProd)) {

            $precioNormal=formatoAPrecio($producto['precio']);
            $precioCD=formatoAPrecio(calcularPrecioDescuento($producto['precio'],$producto['descuento'],0));

            if (strlen ( $producto['nombre'])>23) {
                $nombreProducto = substr($producto['nombre'],0,24).'...';
            }else {
                $nombreProducto = $producto['nombre'];
            }
    ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="<?php echo $producto['img']; ?>">
                        <?php if ($producto['descuento']>0) { ?>
                            <div class="label stockblue"><?php echo $producto['descuento']; ?> % OFF</div>
                            <?php } ?>
                        <ul class="product__hover">
                            <!-- <li><a class="cursor hover-white shadow-s" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fa fa-plus"></i></a></li> -->
                            <li><a class="cursor hover-white shadow-s" onclick="detalles(<?php echo $producto['id'];?>,'producto','contentPrincipalNoSession')"><i class="fa fa-plus"></i></a></li>
                            <li><a class="cursor hover-white shadow-s" onclick=""><i class="fa fa-heart"></i></a></li>
                            <li><a class="cursor hover-white shadow-s" onclick=""><i class="fa fa-cart-plus"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text h-shadow-l">
                        <h6><a><?php echo $nombreProducto; ?></a></h6>
                        <!-- <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div> -->
                        <?php if ($producto['descuento']>0) { ?>
                            <div class="product__price"><?php echo $precioCD; ?> <span><?php echo $precioNormal; ?></span></div>
                        <?php }else{ ?>
                            <div class="product__price"><?php echo $precioNormal; ?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
    <?php 
        }
}


?>