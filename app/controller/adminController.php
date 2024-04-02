<?php


require_once plugin_dir_path(__DIR__) . "model/adminModel.php";
require_once plugin_dir_path(__DIR__) . "controller/getproductController.php";

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
            'Add Product',
            'Add Product',
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

}
