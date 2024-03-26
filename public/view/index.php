<div class=" bg-transparent">
    <div class="container">
        <nav class="nav-gp nav  justify-content-end bg-transparent">
            <!-- <a class="nav-link" onclick="showPage('chatgpt1')" aria-current="page" href="#">Admin</a>
    <a class="nav-link" onclick="showPage('chatgpt2')" href="#">Create Page</a>
    <a class="nav-link" onclick="showPage('chatgpt3')" href="#">Link</a> -->
            <!-- <a class="nav-link "onclick="showPage('chatgpt2')"   href="#">Disabled</a> -->
        </nav>

        <?php
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}amazonid ";
        $row = $wpdb->get_results($query, ARRAY_A);
        // print_r(get_current_user_id());
        require_once __DIR__ . "/add/admin.php";

        if (count($row) >0) {


            require_once __DIR__ . "/add/listProducts.php";
            require_once __DIR__ . "/add/createProduct.php";
            require_once __DIR__ . "/add/modalEditPage.php";
            
        
        ?>


    </div>
</div>
<style>
    #wpcontent {
        padding-left: 0px;
    }
</style>
<script>
    var pages = {
        alocraise2: {
            title: "Create Product"
        },
        alocraise1: {
            title: "Create Amazon Ids "
        },
        alocraise3: {
            title: "Modal "
        },
        alocraise4: {
            title: "List Products"
        },
    }

    showPage()

    function showPage() {
        z = ''
        for (let k in pages) {
            jQuery("#" + k + ">div>div>h3").html(pages[k]["title"])
            z += '<a class="nav-link" onclick="showPage2(\'' + k + '\')" href="#">' + pages[k]["title"] + '</a>'
        }

        jQuery(".nav-gp").attr("style", "background-color: #f2f2f2")
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