<div id="alocraise4">
    <div class="py-3">
        <div class="pb-2">
            <h1 class="text-center"> <?= get_admin_page_title() ?></h1>
        </div>
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
        <tbody>
            <?php
            global $wpdb;
            $query = "SELECT * FROM {$wpdb->prefix}getproduct";
            $result = $wpdb->get_results($query,  ARRAY_A);

            ?>
            <?php foreach ($result as $k => $v) { 
                $result[$k]["product"] = unserialize($result[$k]["product"]);
                
                ?>
                <tr class="delete-item-product<?= $result[$k]["id"] ?>">
                    <th><?= $result[$k]["id"] ?></th>
                    <td><?= $result[$k]["title"] ?></td>
                    <td><?= $result[$k]["product"]["product"]["asin"] ?></td>
                    <td class="btn btn-outline-danger delete-item-product" delete-product="<?= $result[$k]["id"] ?>"> Delete</td>
                    <td class="btn btn-outline-success "> Update</td>
                </tr>

            <?php } ?>
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

    jQuery(document).ready(($)=>{

        $(document).on("click",".trash-product-amazon",() => {
            deleteRow("delete-product", "delete_data_product_id", ".delete-item-product")
        })
    })
</script>