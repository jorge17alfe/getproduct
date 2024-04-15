<?php
// require_once plugin_dir_path(__DIR__) . "model/adminModel.php";
require_once plugin_dir_path(__DIR__) . "controller/getproductController.php";

class GpStoreController
{
    // private $db;
    private $table_store = "gpstore";

    public function __construct()
    {
        // $this->db = new adminModel;

    }

    public function SaveDataStoreId()
    {

        global $wpdb;
        parse_str($_POST["data"], $r);
        foreach ($r["storeid"] as $k => $v) {
            $query = "SELECT id FROM {$wpdb->prefix}{$this->table_store}  WHERE id = $k";
            $result = $wpdb->get_results($query,  ARRAY_A)[0]["id"];
            if ($result) {
                $wpdb->update("{$wpdb->prefix}{$this->table_store}", ["storeid" => $v], ['id' => $k]);
            } else {
                $wpdb->insert("{$wpdb->prefix}{$this->table_store}", ["storeid" => $v]);
            }
        }
        return json_encode("Update");
    }



    public function GetStoreIds()
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}{$this->table_store}";
        $result = $wpdb->get_results($query,  ARRAY_A);
        return json_encode($result);
    }
    
    public function GetStoreId($id = '')
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}{$this->table_store} WHERE id = {$id}";
        $result = $wpdb->get_results($query,  ARRAY_A);
        if(count($result) > 0){
            return $result[0];
        }else{
            $result['storeid'] = '<b class="text-danger">Add store</b>';
            return $result;
        }
        // <i class="bi bi-amazon"></i>
    }

    public function DeleteDataStoreId()
    {
        global $wpdb;
        $id = intval($_POST["data"]);
        $result = $wpdb->delete("{$wpdb->prefix}{$this->table_store}", ["id" => $id]);
        return  json_encode($result);
    }
}
