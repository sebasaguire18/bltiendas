<?php include '../php/function.php'; 
    $categoria = $_POST['categoria'];
?>
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <div class="section-title">
                    <h4>Productos</h4>
                </div>
            </div>
            <div class="col-lg-8 col-md-8">
                <div class="section-title dp-flex jfy-ctn-center ">
                    <h4><?php echo consultarNombreCat($categoria); ?></h4>
                </div>
            </div>
        </div>
        <div class="row property__gallery">
            <div class="col-lg-3 col-md-3">
                <div class="shop__sidebar">
                    <div class="sidebar__categories">
                        <div class="section-title">
                            <h4>Categorias</h4>
                        </div>
                        <div class="categories__accordion">
                            <div class="accordion" id="accordionFilterShop">
                                <div class="card">
                                    <div class="card-heading active">
                                        <a data-toggle="collapse" data-target="#collapseFilterShop">Todas</a>
                                    </div>
                                    <div id="collapseFilterShop" class="collapse show" data-parent="#accordionFilterShop">
                                        <div class="card-body">
                                            <ul>
                                                <?php listadoCatFilter(); ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php consultarProdFilter($categoria); ?>
        </div>
    </div>
</section>

<?php include '../includes/band.php'; ?>

<!-- <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            <div class="col-3">
                <div id="preloder">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>
</div> -->