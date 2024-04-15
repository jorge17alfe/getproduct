<?php
/*
Plugin Name: Add Product
Description: This is a Get Product
Version: 1.00
*/

require_once "app/controller/adminController.php";
$adminController =   new GpAdminController;

if(!defined('GPURLPLUGIN')) define('GPURLPLUGIN', basename(dirname(__FILE__)) . "/public/view/index.php");


register_activation_hook(__FILE__, array($adminController, 'Active'));



register_deactivation_hook(__FILE__, array($adminController, 'Desactive'));


function GpCreateMenu()
{
    global $adminController;
    $adminController->CreateMenu(plugin_dir_path(__FILE__) . 'public/view/index.php');
}
add_action('admin_menu', 'GpCreateMenu');



function GpRegisterBootstrapJS($hook)
{

    if ($hook != GPURLPLUGIN) {
        return;
    }
    wp_enqueue_script('bootstrapJs', plugins_url('public/assets/bootstrap-5.2.3-dist/js/bootstrap.bundle.js', __FILE__), array('jquery'));
}
add_action('admin_enqueue_scripts', 'GpRegisterBootstrapJS');


function GpRegisterBootstrapCSS($hook)
{
    if ($hook != GPURLPLUGIN) {
        return;
    }
    wp_enqueue_style('bootstrapCss', plugins_url('public/assets/bootstrap-5.2.3-dist/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('bootstrapIconsCss', plugins_url('public/assets/bootstrap-5.2.3-dist/css/font/bootstrap-icons.min.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'GpRegisterBootstrapCSS');



// // //Register js own

function GpRegisterJsGeneratePage($hook)
{
    if ($hook != GPURLPLUGIN) {
        return;
    }
    wp_enqueue_script('JsExternal', plugins_url('public/assets/js/index.js', __FILE__), array('jquery'));
    wp_localize_script('JsExternal', 'PetitionAjax', [
        'url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('seg')
    ]);
}
add_action('admin_enqueue_scripts', 'GpRegisterJsGeneratePage');



//  data  AMAZONIDS
require_once "app/controller/storeController.php";
$storeController =   new GpStoreController;


function GpgetStoreIds()
{
    global $storeController;
    echo $storeController->GetStoreIds();
}

add_action('wp_ajax_nopriv_get_data_store_ids', 'GpGetStoreIds');
add_action('wp_ajax_get_data_store_ids', 'GpGetStoreIds');

function GpDeleteStoreId()
{
    global $storeController;
    echo $storeController->DeleteDataStoreId();
}

add_action('wp_ajax_nopriv_delete_data_store_id', 'GpDeleteStoreId');
add_action('wp_ajax_delete_data_store_id', 'GpDeleteStoreId');



function GpSaveStoreId()
{
    global $storeController;
    echo $storeController->SaveDataStoreId();
}

add_action('wp_ajax_nopriv_save_data_store_id', 'GpSaveStoreId');
add_action('wp_ajax_save_data_store_id', 'GpSaveStoreId');



// data PRODUCTS
require_once "app/controller/getproductController.php";
$getProductController =   new GpGetProductController;


function GpgetProducts()
{
    global $getProductController;
    echo $getProductController->GpgetProducts();
}

add_action('wp_ajax_nopriv_get_data_products', 'GpGetProducts');
add_action('wp_ajax_get_data_products', 'GpGetProducts');

function GpSaveCreateStoreProduct()
{

    global $getProductController ;
    echo  $getProductController->SaveCreateStoreProduct();
   
}

add_action('wp_ajax_nopriv_save_create_store_product', 'GpSaveCreateStoreProduct');
add_action('wp_ajax_save_create_store_product', 'GpSaveCreateStoreProduct');

function GpSaveCreateStoreProductAsin()
{

    global $getProductController ;
    echo  $getProductController->SaveCreateStoreProductAsin();
   
}

add_action('wp_ajax_nopriv_save_data_create_product_asin', 'GpSaveCreateStoreProductAsin');
add_action('wp_ajax_save_data_create_product_asin', 'GpSaveCreateStoreProductAsin');


function GpDeleteProduct(){
    global $getProductController;
    echo $getProductController->DeleteDataProduct();
}

add_action('wp_ajax_nopriv_delete_data_product_id', 'GpDeleteProduct');
add_action('wp_ajax_delete_data_product_id', 'GpDeleteProduct');




// data SHORTCODE
function GpGetShortCode($atts)
{
    global $getProductController ;
    return  $getProductController->GpGetShortCode($atts);
}

add_shortcode("GETPRODUCT", "GpGetShortCode");
