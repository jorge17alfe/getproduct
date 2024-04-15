<div id="alocraise1">
    <div class="py-3">
     <!--    <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>-->
        <div class="">
            <h3></h3>
        </div>

    </div> 

    <form class=" row g-2  my-3" id="formDataStore" novalidate>
        <input type="hidden" class="form-control form-control-sm" value="<?= get_current_user_id() ?>" id="userId" name="userId" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

        <div class="d-flex justify-content-center col-12 ">
            <button class=" btn btn-success" id="addbtnstore">
                Add Store ID
            </button>
        </div>
        <div class="" id="result-storeid">

        </div>

        
        <?php $compo->buttonSend( "Save" , "btnSendStore" );  ?>
    </form>
</div>

<script>
   
    jQuery(document).ready(($) => {
        let url = PetitionAjax.url;
        $("#addbtnstore").on("click", (e) => {
            e.preventDefault();
            $("#result-storeid").append(addelementstoreid(""));

        })


        $("#btnSendStore").on("click", (e) => {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: url,
                data: {
                    action: "save_data_store_id",
                    nonce: PetitionAjax.security,
                    data: $("#formDataStore").serialize(),
                }

            }).done((response) => {
                response = response.substring(0, response.length - 1);
                response = JSON.parse(response);
                // console.log(response)

                // $("#result-storeid").html('');
                // GetstoreIds();
                location.reload()
            })

        })

        const GetstoreIds = () => {

            $.get({
                url,
                data: {
                    action: "get_data_store_ids",
                    nonce: PetitionAjax.security,
                }
            }).done(response => {
                response = response.substring(0, response.length - 1);
                response = JSON.parse(response);
                // console.log(response)
                stores = response;
                
                for (let i = 0; i < response.length; i++) {
                    $("#result-storeid").append(addelementstoreid("disabled", response[i]["id"], response[i]["storeid"]));
                }

            })
        }
        GetstoreIds();

        $(document).on("click", ".trash-storeid", () => {
            deleteRow("delete-storeid", "delete_data_store_id", ".delete-item-storeid")
        })


    })

    const update = (id) => {
        jQuery(document).ready(($) => {

            console.log(id)
            if ($(`#${id}`).attr("disabled")) {
                $(`#${id}`).removeAttr("disabled")
                $(`.lock-unlock${id}`).html(`<i class="bi bi-unlock"></i>`)

            } else {
                $(`.lock-unlock${id}`).html(`<i class="bi bi-lock"></i>`)
                $(`#${id}`).attr("disabled", "disabled")

            }
        })
    }

    function addelementstoreid(disabled, id = '', value = "", ) {
        var add = '';
        if (id.length > 0) add = `<${id}>`
        let result = `<div class='input-group input-group-sm  mb-1 delete-item-storeid${id}'  >`;

        result += `<span class='input-group-text'>Store ID ${add}</span>`;
        result += `<input ${disabled} type='text' class='form-control form-control-sm' placeholder='Your id store' id='${id}' name='storeid[${id}]' value='${value}'  aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm'>`;
        result += `<a href="javascript:void(0)" onclick='update(${id})' class="btn btn-outline-success ms-1 lock-unlock${id} rounded"><i class="bi bi-lock"></i></a>`;
        result += `<a href="javascript:void(0)" class="btn btn-outline-danger ms-1 trash-storeid rounded" delete-storeid='${id}'><i class="bi bi-trash " ></i></a>`;

        result += `</div>`;
        return result;

    }
</script>