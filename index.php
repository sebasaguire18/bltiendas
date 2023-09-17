<?php
    session_start();
    error_reporting(0);
    
    include 'includes/resources.php';

    if($_SESSION['id_user']){
        $idUserSession=$_SESSION['id_user'];

  	    header("location: welcome.php");

    }else{
?>

<!doctype html>
<html lang="es">
    <head>
        <title id="titlePageNS">Inicio</title>
        <?php include 'includes/link.php'; ?>
    </head>
    <body>
        <div id="app">
            <?php include 'includes/nav.php'; ?>
        
            <div id="main">        
                <section id="contentNavNoSession">

                </section>
                
                <!-- Page Content  -->
                <div class="page-content" id="contentPrincipalNoSession">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-3">
                            <div id="preloder">
                                <div class="loader"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include 'includes/footer.php'; ?>
            </div>
        </div>
        
        <?php include 'includes/script.php'; ?>
        
    </body>
</html>

<?php
    }
?>