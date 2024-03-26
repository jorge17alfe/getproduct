<div  id="alocraise3">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
        <div class="">
            <h3></h3>
        </div>
    </div>


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Create Page IA
    </button>





    <!--Modal  ------------------------------------------------------ -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                </div>
            </div>
        </div>
    </div>
    <!-- end modal ------------------------------------------------------ -->

    <!-- Carrousel ---------------------->

    <div class="justify-content-center">
        <div id="carouselExampleControls" class="carousel slide w-25 mt-5" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="<?= plugin_dir_url(__FILE__) . '../../assets/img/1.jpg' ?>" class="d-block " width="350px" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= plugin_dir_url(__FILE__) . '../../assets/img/2.jpg' ?>" class="d-block" width="350px" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="<?= plugin_dir_url(__FILE__) . '../../assets/img/3.jpg' ?>" class="d-block " width="350px" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- end Carrousel ---------------------->
</div>