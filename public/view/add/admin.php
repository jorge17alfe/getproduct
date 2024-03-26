<div id="alocraise1">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
        <div class="">
            <h3></h3>
        </div>

    </div>

    <form class=" row g-2  my-3" id="formData" novalidate>
        <input type="hidden" class="form-control form-control-sm" value="<?= get_current_user_id() ?>" id="userId" name="userId" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    
        <div class="d-flex justify-content-center col-12 ">
            <button class=" btn btn-success" id="addproduct">
                Add Amazon ID
            </button>
        </div>
        <div class="col-10 col-md-6 " id="result">

        </div>

        <div class="d-flex justify-content-center">
            <button class="btn btn-primary " id="btnSend">
                Save
            </button>
        </div>
    </form>
</div>

<script>
    let ae = 1;
    jQuery(document).ready(($) => {
        let url = PetitionAjax.url;
        $("#addproduct").on("click", (e) => {
            e.preventDefault();
            $("#result").append(addelement(""));

        })


        $("#btnSend").on("click", (e) => {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    action: "save_data_amazon_id",
                    nonce: PetitionAjax.security,
                    data: $("#formData").serialize(),
                }

            }).done((response) => {
                response = response.substring(0, response.length - 1);
                response = JSON.parse(response);
                // console.log(response)

                $("#result").html('');
                GetAmazonIds();
            })

        })

        const GetAmazonIds = () => {

            $.get({
                url,
                data: {
                    action: "get_data_amazon_ids",
                    nonce: PetitionAjax.security,
                }
            }).done(response => {
                response = response.substring(0, response.length - 1);
                response = JSON.parse(response);
                // console.log(response)
                for (let i = 0; i < response.length; i++) {
                    $("#result").append(addelement("disabled",response[i]["id"], response[i]["amazonid"]));
                }

            })
        }
        GetAmazonIds();

        $(document).on("click", ".delete-trash", (e) => {
            e.preventDefault();
          

            if (confirm("Are you sure you want to delete it?")) {
                const id = $(e.target).attr("delete-trash");
                $.post({
                    url,
                    data: {
                        action: "delete_data_amazon_id",
                        nonce: PetitionAjax.security,
                        data: id
                    }
                }).done(response => {
                    response = response.substring(0, response.length - 1);
                    // console.log(response)
                    $(".delete-row"+id).remove();
                })
            }

        })
        
    })
    
    const update = (id)=>{
        jQuery(document).ready(($) => {

            console.log(id)
            if($(`#${id}`).attr("disabled")){
                $(`#${id}`).removeAttr("disabled")
                $(`.lock-unlock${id}`).html(`<i class="bi bi-unlock"></i>`)
                
            }else{
                $(`.lock-unlock${id}`).html(`<i class="bi bi-lock"></i>`)
                $(`#${id}`).attr("disabled", "disabled")

            }
        })
    }
    function addelement(disabled , id = '', value = "",  ) {
        var add ='';
        if(id.length  > 0 ) add = `<${id}>`
        let result = `<div class='input-group input-group-sm  mb-1 delete-row${id}'  >`;
        
        result += `<span class='input-group-text'>Amazon ID ${add}</span>`;
        result += `<input ${disabled} type='text' class='form-control form-control-sm' placeholder='Your id amazon' id='${id}' name='amazonid[${id}]' value='${value}'  aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>`;
        result += `<a href="javascript:void(0)" onclick='update(${id})' class="btn btn-outline-success lock-unlock${id}"><i class="bi bi-lock"></i></a>`;
        result += `<button  class="btn btn-outline-danger"><i class="bi bi-trash delete-trash" delete-trash='${id}'></i></button>`;
      
        result += `</div>`;
        return result;

    }
</script>