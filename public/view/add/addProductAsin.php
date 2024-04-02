    <!--Modal  ------------------------------------------------------ -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product for ASIN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form class=" row g-2  my-3 " id="formCreateProductAsin" novalidate>
                        <div class="col-12">
                            <div class="input-group input-group-sm ">
                                <span class="input-group-text">ASIN</span>
                                <input type="text" class="form-control form-control-sm"  name="asin" value="B0C2KFVGVR"   aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
                            </div>
                        </div>

                        <?php  $compo->buttonSend("Crear Product", "btnSendProductAsin");  ?>

                    </form>


                </div>
            </div>
        </div>
    </div>

    <script>
jQuery(document).ready(($)=>{

    $("#btnSendProductAsin").on("click", (e) => {
            e.preventDefault();
            $.ajax({
                method: "POST",
                url: PetitionAjax.url,
                data: {
                    action: "save_data_create_product_asin",
                    nonce: PetitionAjax.security,
                    data: $("#formCreateProductAsin").serialize(),
                }

            }).done((response) => {
                // response = response.substring(0, response.length - 1);
                // response = JSON.parse(response);
                // console.log(response)
                location.reload()
            })

        })


})

    </script>