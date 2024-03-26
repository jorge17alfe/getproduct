<div  id="alocraise2">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
        <div class="">
            <h3></h3>
        </div>
    </div>
    <form class=" row g-2  my-3" id="formCreateProduct" novalidate>
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">ASIN</span>
                <input type="text" class="form-control form-control-sm" value="" id=""  name="product[asin]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>
            </div>
        </div>
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Title</span>
                <input type="text" class="form-control form-control-sm" value="" id="" required name="product[title]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Sub-title</span>
                <input type="text" class="form-control form-control-sm" value="" id="" required name="product[subtitle]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Price</span>
                <input type="text" class="form-control form-control-sm" value="" id="" required name="product[price]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Link Product</span>
                <input type="text" class="form-control form-control-sm" value="" id="" required name="product[linkproduct]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
            </div>
        </div>
        <div class="col-12">
            <div class="input-group input-group-sm ">
                <span class="input-group-text">Links Images: </span>
                
                <button  class="btn btn-success add-link-image"><i class="bi bi-plus-square "></i></button>
            </div>
            <div id="addLinkImage" class="ms-4"></div>
        </div>
      
        <div class="d-flex justify-content-center">
            <button class="btn btn-primary " id="btnSendProduct">
                Save
            </button>
        </div>
    </form>
  

</div>
<script>
jQuery(document).ready(($)=>{
    $(".add-link-image").on("click", e =>{
        // console.log()
        e.preventDefault()
        $("#addLinkImage").append(addLinkImages())
    })
    
    const addLinkImages = ()=>{
        append =`<div class="input-group input-group-sm my-1">`;
        append +=`<span class="input-group-text">Link Image: </span>`;
        append +=`<input type="text" class="form-control form-control-sm" value="" name="product[image][]"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">`;
        append +=`</div>`;
        return append;
    }
    
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
