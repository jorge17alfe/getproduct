    <!--Modal  ------------------------------------------------------ -->

    <div class="modal fade pt-5" id="exampleModal" tabindex="-2" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product for ASIN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form class=" row g-2  my-3 " id="formCreateProductAsin" novalidate>
                        <!-- <div class="col-12">
                            <div class="input-group input-group-sm ">
                                <span class="input-group-text">ASIN</span>
                                <input type="text" class="form-control form-control-sm" name="asin" value="B0C2KFVGVR" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div> -->

                        <?php $compo->inputCreate("ASIN" , '', "asin", "", "", "Amazon ASIN Product");  ?>

                        <?php $compo->buttonSend("Crear Product", "btnSendProductAsin");  ?>

                    </form>


                </div>
                <div id="result_a" class="m-auto p-3"></div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(($) => {

            $("#btnSendProductAsin").on("click", (e) => {
                e.preventDefault();
                $("#result_a").html('');
                $.ajax({
                    method: "POST",
                    url: PetitionAjax.url,
                    data: {
                        action: "save_data_create_product_asin",
                        nonce: PetitionAjax.security,
                        data: $("#formCreateProductAsin").serialize(),
                    }

                }).done((response) => {
                    response = response.substring(0, response.length - 1);
                    // response = JSON.parse(response);
                    // console.log(response)
                    if (response.ok) {

                        // location.reload();
                    }
                    $("#result_a").html(response);
                })

            })


        })
    </script>
