<?php


 require_once "add/components.php";
$compo =  new ComponentsAp; ?>
<script>
    let stores = '';
</script>

<div class="">
    <div class="pt-5 ">
        <h1 class="fs-3 text-center text-uppercase"> <?= get_admin_page_title() ?></h1>
    </div>


    <div class=" ">
        <nav class="nav-gp nav  justify-content-center  border-top" style="background-color: #1d2327">

        </nav>
    </div>
    <div class="container-fluid bg-light  py-5">
        <div class="container" style="max-width: 700px;">

            <?php
            global $wpdb;
            $query = "SELECT * FROM {$wpdb->prefix}gpstore ";
            $row = $wpdb->get_results($query, ARRAY_A);
            // print_r(get_current_user_id());
            $r = json_encode($row);
            echo "<script> stores = {$r}</script>";
            require_once __DIR__ . "/add/getstore.php";
            if (count($row) > 0) {


                require_once __DIR__ . "/add/createProduct.php";
                require_once __DIR__ . "/add/listProducts.php";
                // require_once __DIR__ . "/add/modalEditPage.php";


            ?>


        </div>
    </div>
    <div id="wpfooter">

    </div>
</div>
<style>
    #wpcontent {
        padding-left: 0px;
    }
</style>
<script>
    var pages = {
        alocraise1: {
            title: "Create Store Ids "
        },
        alocraise2: {
            title: "Create Product"
        },
        // alocraise3: {
        //     title: "Modal "
        // },
        alocraise4: {
            title: "List Products"
        },
    }

    showPage()

    function showPage() {
        z = ''
        for (let k in pages) {
            jQuery("#" + k + ">div>div>h3").html(pages[k]["title"]).attr("class", "text-uppercase fs-5")
            z += '<a class="nav-link link-light px-3  py-1 text-uppercase" onclick="showPage2(\'' + k + '\')" href="#"><small><small>' + pages[k]["title"] + '</small></small></a>'
        }
        jQuery(".nav-gp").html(z)
    }

    showPage2()

    function showPage2(e = "alocraise1") {

        for (let k in pages) {
            if (k == e) {
                jQuery("#" + k).show()
            } else {
                jQuery("#" + k).hide()
            }
        }

    }
</script>


<?php
            }
?>