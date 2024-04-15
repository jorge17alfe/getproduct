<div id="alocraise4">
    <div class="py-3">
        <!-- <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div> -->
        <div class="">
            <h3></h3>
        </div>
    </div>
    <table class="table" id="listPages">
        <thead>
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Title</th>
                <th scope="col">ASIN</th>
            </tr>
        </thead>
        <tbody id="result-products">

        </tbody>
    </table>
    <div class="">
        <p class=" d-flex justify-content-around">
            <a onclick=' pagination(-1)' href="javascritp:void(0);">PREV</a>
            <!-- <a onclick=' pagination(+1)' href="javascritp:void(0);">1</a>
            <a onclick=' pagination(+1)' href="javascritp:void(0);">2</a>
            <a onclick=' pagination(+1)' href="javascritp:void(0);">2</a> -->
            <a onclick=' pagination(+1)' href="javascritp:void(0);">NEXT</a>
        </p>
    </div>
</div>


<script>
    let products = '';



    jQuery(document).ready(($) => {
        $(document).on("click", ".btn-delete-item", () => {
            deleteRow("delete-productid", "delete_data_product_id", ".delete-item-product")
        })







        $(document).on("click", ".btn-update-item", () => {
            $("#addLinkImage").html('')

            const getid = $(document)[0].activeElement;
            id = $(getid).attr("update-productid");

            showPage2("alocraise2")
            $("#asin").val(products[id]["product"]["product"]["asin"])
            $("#title").val(products[id]["product"]["product"]["title"])
            $("#subtitle").val(products[id]["product"]["product"]["subtitle"])
            $("#price").val(products[id]["product"]["product"]["price"])
            $("#linkproduct").val(products[id]["product"]["product"]["linkproduct"])

            $("#asin").before(`<input type="hidden" class="form-control form-control-sm" value="${products[id]["id"]}" name="id"  aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" required>`)

            let image = products[id]["product"]["product"]["image"];

            for (let i = 0; i < image.length; i++) {
                $("#addLinkImage").append(addLinkImages(image[i], i))
            }

            $("#example" + products[id]["product"]["product"]["storename"]).attr("selected", "selected")


            console.log(products[id]["product"]["product"]["storename"]);

        })
    })

    const addelementproduct = (response, i) => {


        let result = ''
        result += `${response["title"]}`;


        result += `<tr class="delete-item-product${response["id"]}">
                    <th>${response["id"]}</th>
                    <td>${response["title"]}</td>
                    <td>${response['product']['product']["asin"]}</td>
                    <td class="p-0 "><a href="javascript:void(0)" class="btn  btn-outline-danger btn-delete-item" delete-productid="${response["id"]}"> <i class="bi bi-trash "></a></td>
                    <td class="p-0 "> <a href="javascript:void(0)" class="btn btn-outline-success btn-update-item" update-productid="${i}"><img width="20" src="<?= plugins_url('../../assets/img/update.png', __FILE__) ?>" alt=""></a></td>
                </tr>`

        return result;

    }
    let nropagination = 0;
    let total_rows = 10;

    const GetProducts = () => {
        jQuery(document).ready(($) => {
            console.log(nropagination, total_rows)
            // console.log(products.length)
            $.post({
                url: PetitionAjax.url,
                data: {
                    action: "get_data_products",
                    nonce: PetitionAjax.security,
                    data: {
                        nropagination,
                        total_rows
                    }
                }
            }).done(response => {
                $("#result-products").html("")
                response = response.substring(0, response.length - 1);
                response = JSON.parse(response);
                products = response;

                console.log(response)







                for (let i = 0; i < products.length; i++) {
                    $("#result-products").append(addelementproduct(products[i], i));
                }

            })
        })
    }

    GetProducts();

    const pagination = (page) => {




        nropagination += page
        if (page < 0) nropagination = 0

        if (products.length < total_rows) nropagination = nropagination - 1
        GetProducts()
    }
</script>