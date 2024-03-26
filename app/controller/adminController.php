<?php


require_once plugin_dir_path(__DIR__) . "model/adminModel.php";

class GpAdminController
{
    private $status = '';
    private $db;
    private $table_admin = "getproduct";

    public function __construct()
    {
        $this->db = new adminModel;
    }

    public function Active()
    {
        $a = new adminModel;
        $a->Active();
    }
    public function Desactive()
    {
        flush_rewrite_rules();
    }

    public function CreateMenu($urlFile)
    {
        add_menu_page(
            'Get product',
            'get product',
            'manage_options',
            $urlFile,
            null,
            plugin_dir_url(__FILE__) . '../../public/assets/img/icon.png',
            '1'
        );
    }


    public function SaveDataAmazonId()
    {
        global $wpdb;
        parse_str($_POST["data"], $r);
        foreach ($r["amazonid"] as $k => $v) {
            $query = "SELECT id FROM {$wpdb->prefix}amazonid  WHERE id = $k";
            $result = $wpdb->get_results($query,  ARRAY_A)[0]["id"];
            if ($result) {
                $wpdb->update("{$wpdb->prefix}amazonid", ["amazonid" => $v], ['id' => $k]);
            } else {
                $wpdb->insert("{$wpdb->prefix}amazonid", ["amazonid" => $v]);
            }
        }
        return json_encode("Update");
    }

    public function GetAmazonIds()
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}amazonid";
        $result = $wpdb->get_results($query,  ARRAY_A);
        return json_encode($result);
    }
    public function DeleteDataAmazonId()
    {
        global $wpdb;
        $id = intval($_POST["data"]);
        $result = $wpdb->delete("{$wpdb->prefix}amazonid", ["id" => $id]);
        return  json_encode($result);
    }
    public function SaveCreateAmazonProduct()
    {
        global $wpdb;
        parse_str($_POST["data"], $tr);
        $_POST["data"] = $tr;
        $title = $tr["product"]["title"];
        $re = serialize($_POST["data"]);
        $ins = ["title" => $title, "product" => $re];

        $wpdb->insert("{$wpdb->prefix}getproduct", $ins);

        // return json_encode("ok save...");
        return;
    }


    public function GpGetShortCode($atts)
    {
        global $wpdb;
        $id = $atts['id'];
        $query = "SELECT * FROM {$wpdb->prefix}getproduct WHERE id = $id";
        $result = $wpdb->get_results($query,  ARRAY_A);

        if (empty($result)) return;

        $view = unserialize($result[0]['product']);

        if (empty($view['product']['linkproduct'])) $view['product']['linkproduct'] = "https://www.amazon.es/dp/" . $view['product']['asin'];

        $q = '';
        $q .= '<div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="carousel">
                    <div class="card h-100 ">
                         <div class="carousel-inner">';


        foreach ($view['product']['image'] as $k => $v) {

            if ($k == 0) {
                $active = "active";
            } else {
                $active = "";
            };

            $q .= '             <div class="carousel-item '.$active.'">
                                    <img height="200" src="' . $view['product']['image'][$k] . '" class="d-block m-auto pt-2" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title">' . $view['product']['title'] . '</h5> 
                                        <p class="text-muted">' . $view['product']['subtitle'] . '</p>
                                    </div>          
                                    <div class="">
                                        <div class="text-center">          
                                            <p class="text-muted">' . $view['product']['price'] . '</p>
                                            <a target="_blank" href="' . $view['product']['linkproduct'] . '" class="btn btn-outline-success " >Comprar en <i class="bi bi-amazon"></i></a>
                                        </div>          
                                    </div>
                                </div>';
        }





        $q .=           '</div>
                    </div>
                </div>';


        return $q;
    }
}
