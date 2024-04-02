<?php


require_once plugin_dir_path(__DIR__) . "model/adminModel.php";

if (file_exists(plugin_dir_path(__DIR__) . "../vendor/autoload.php")) {
    include_once plugin_dir_path(__DIR__) . '../vendor/autoload.php';
}

use Goutte\Client;



class GpGetProductController
{
    private $db;

    public function __construct()
    {
        $this->db = new adminModel;
    }

    public function contString($data)
    {
        $string =  explode(' ', $data);
        $result = '';
        if (count($string) === 1) {
            $result = $string[0];
        } else {
            foreach ($string as $k => $v) {
                $result .= $v;
                if ($k < (count($string) - 1)) {
                    $result .= '+';
                }
            }
        }
        return $result;
    }


    public function getUrlProduct($asin, $amazonId)
    {
        $asin = $this->contString($asin);
        $str = 'https://www.amazon.es/dp/' . $asin . '?_encoding=UTF8&tag=' . $amazonId . '&language=es_ES';
        return $str;
    }


    public function SaveCreateAmazonProductAsin()
    {
        $res = [];
        if (!file_exists(plugin_dir_path(__DIR__)  . "../vendor/autoload.php")) {
            return json_encode($res["info"] = "eject dependencias [composer install] and will try again.");
        }

        try {
            parse_str($_POST["data"], $tr);
            $_POST["data"] = $tr;
            $asin = $_POST["data"]["asin"];

            $res["product"]["id_amazon"] = $this->GpGetAmazonAfiliate();
            $res["product"]['asin'] = $asin;
            $res["product"]['linkproduct'] = $this->getUrlProduct($res["product"]['asin'], $res["product"]["id_amazon"]);

            $client = new Client();
            $crawler = $client->request("GET", $res["product"]['linkproduct']);




            if ($crawler->filter('#productTitle')->count() > 0) {
                $res["title"] = $crawler->filter('#productTitle')->text();
                $res["product"]["title"] = $res["title"];
                $res["product"]["image"][] = $crawler->filter('#imgTagWrapperId > img')->attr("src");
                // $res["product"]["image"][] = $crawler->filter('#imgTagWrapperId > img')->attr("src");
                // $res["product"]["image"][] = $crawler->filter('#imgTagWrapperId > img')->attr("src");
                $res["product"]["price"] = $crawler->filter('.a-text-price')->text();
                $this->SaveCreateAmazonProduct($res);
                $res["ok"] = "ok saved..";
                return  json_encode($res);
            }


            
            return json_encode($res["info"] = "There is some problem. Try again later.");
        } catch (Exception $e) {
            return json_encode($res['error'] = $e->getMessage());
        }
    }

    public function GpGetAmazonAfiliate()
    {
        global $wpdb;

        $query = "SELECT * FROM {$wpdb->prefix}amazonid ORDER BY id DESC limit 1";
        return $wpdb->get_results($query,  ARRAY_A)[0]["amazonid"];
    }

    public function SaveCreateAmazonProduct($product = null)
    {
        global $wpdb;
        if (isset($product)) {
            $title = $product["title"];

            $re = serialize($product);
        } else {
            parse_str($_POST["data"], $tr);
            $_POST["data"] = $tr;
            $title = $tr["product"]["title"];
            $re = serialize($_POST["data"]);
        }




        $ins = ["title" => $title, "product" => $re];

        if (!empty($_POST["data"]["id"]) && isset($_POST)) {
            $wpdb->update("{$wpdb->prefix}getproduct", $ins, ['id' => $_POST["data"]["id"]]);
            return;
        }

        $wpdb->insert("{$wpdb->prefix}getproduct", $ins);

        return;
    }


    public function GpgetProducts()
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}getproduct ORDER BY id DESC ";
        $result = $wpdb->get_results($query,  ARRAY_A);

        foreach ($result as $k => $v) {
            $result[$k]["product"] = unserialize($result[$k]["product"]);
        }
        return json_encode($result);
    }

    public function GpgetProduct()
    {
        global $wpdb;
        $query = "SELECT * FROM {$wpdb->prefix}getproduct";
        $result = $wpdb->get_results($query,  ARRAY_A);

        foreach ($result as $k => $v) {
            $result[$k]["product"] = unserialize($result[$k]["product"]);
        }
        return json_encode($result);
    }

    public function DeleteDataProduct()
    {
        global $wpdb;
        $id = intval($_POST["data"]);
        $result = $wpdb->delete("{$wpdb->prefix}getproduct", ["id" => $id]);
        return  json_encode($result);
    }



    public function GpGetShortCode($atts)
    {
        global $wpdb;
        $id = $atts['id'];
        $query = "SELECT * FROM {$wpdb->prefix}getproduct WHERE id = $id";
        $result = $wpdb->get_results($query,  ARRAY_A);

        if (empty($result)) return;

        $view = unserialize($result[0]['product']);

        if (empty($view['product']['linkproduct'])) $view['product']['linkproduct'] = $this->getUrlProduct($view['product']['asin'], $this->GpGetAmazonAfiliate());
        if (empty($view['product']['subtitle'])) $view['product']['subtitle'] = "";
        if (count($view['product']['image']) == 1) {

            $active_carrousel = "";
        } else {
            $active_carrousel = "carousel";
        }

        $q = '<div class="card h-100 shadow my-4" >';
        $q .=   '<div id="carouselExampleSlidesOnly" class="carousel slide " data-bs-ride="' . $active_carrousel . '">
                   
                         <div class="carousel-inner">';


        foreach ($view['product']['image'] as $k => $v) {

            if ($k == 0) {
                $active = "active";
            } else {
                $active = "";
            };

            $q .= '          <div class="carousel-item ' . $active . '">
                                <img style="max-width:350px; max-height:350px" src="' . $view['product']['image'][$k] . '" class="d-block m-auto py-3" alt="...">
                            </div>';
        }





        $q .=           '</div>
                   
                </div>';
        $q .= '<div class="p-3 container text-center"> 
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

        $q .= '</div>';

        return $q;
    }
}
