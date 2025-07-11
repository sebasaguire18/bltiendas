<?php
  session_start();

    if($_SESSION['id_user']){
        $idUserSession=$_SESSION['id_user'];
?>

<!doctype html>
<html lang="es">
    <head>
        <title id="titlePage">Inicio</title>
        <?php include 'includes/link.php'; ?>
    </head>
    <body>
        <div id="app">
            <span class="ir-arriba icon-chevron-thin-up shadow"></span>
            <?php include 'includes/nav.php'; ?>
        
            <div id="main">        
                <section id="contentNav">

                </section>
                
                <!-- Page Content  -->
                <div class="page-content" id="contentPrincipal">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-3">
                            <img src="assets/vendors/svg-loaders/puff.svg" width="50%">
                        </div>
                    </div>
                </div>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
        
        <?php include 'includes/script.php'; ?>
        
    </body>
</html>
<script>
	contenido('index',true);

</script>

<?php
  }else{
    header("location:index.php");
  }
?>