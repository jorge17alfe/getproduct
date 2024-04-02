<div id="alocraise2">
    <div class="py-3">
        <div class="">
            <h3></h3>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create Product for ASIN
        </button>
    </div>
    <form class=" row g-2  my-3 " id="formCreateProduct" novalidate>
        
        <?php $compo->inputCreate("ASIN", '', "product[asin]", "asin", "");  ?>
       
        <?php $compo->inputCreate("Title", '', "product[title]", "title", "");  ?>
       
        <?php $compo->inputCreate("Sub", '', "product[subtitle]", "subtitle", "");  ?>
       
        <?php $compo->inputCreate("Price", '', "product[price]", "price", "");  ?>
       
        <?php $compo->inputCreate("Link Product" , '', "product[linkproduct]", "linkproduct", "");  ?>
       
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Links Images: </span>

                <button class="btn btn-success add-link-image"><i class="bi bi-plus-square "></i></button>
            </div>
            <div id="addLinkImage" class="ms-4"></div>
        </div>

        <?php $compo->buttonSend("Save", "btnSendProduct");  ?>


    </form>





    <?php
    include_once "addProductAsin.php";
    ?>




</div>

<script>
    const addLinkImages = (value = '', i = '') => {
        append = `<div class="input-group input-group-sm my-1 remove-item-linkimage${i}">`;
        append += `<span class="input-group-text">Link Image: </span>`;
        append += `<input type="text" class="form-control form-control-sm" value="${value}" name="product[image][]"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">`;
        append += `<a href="javascript:void(0)" class="btn  btn-outline-danger btn-trash-linkimage" delete-imageid="${i}"> <i class="bi bi-trash"></a>`;
        append += `</div>`;
        return append;
    }

    jQuery(document).ready(($) => {
        $(".add-link-image").on("click", e => {

            e.preventDefault()
            $("#addLinkImage").append(addLinkImages())
        })

        $(document).on("click", ".btn-trash-linkimage", (e) => {
            console.log(e.target)

            const getid = $(document)[0].activeElement;
            id = $(getid).attr("delete-imageid");;
            $(".remove-item-linkimage" + id).hide("slow");
            setTimeout(() => $(".remove-item-linkimage" + id).remove(), 500)

        })

        $(".btn-trash-linkimage").click((e) => {})


        let url = PetitionAjax.url;
        $("#btnSendProduct").on("click", (e) => {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    action: "save_create_amazon_product",
                    nonce: PetitionAjax.security,
                    data: $("#formCreateProduct").serialize(),
                }

            }).done((response) => {
                // response = response.substring(0, response.length - 1);
                // response = JSON.parse(response);
                // console.log(response)
                location.reload()
                // $("#result").html('');

            })

        })
    })
</script>