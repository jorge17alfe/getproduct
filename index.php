<?php
/*
Plugin Name: Get Product
Description: This is a Get Product
Version: 1.00
*/

// require_once "app/controller/generatePageController.php";
require_once "app/controller/adminController.php";
// $generatePageController =   new GetProductController;
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
    wp_enqueue_script('JsExternal', plugins_url('public/assets/js/index.js', __FILE__), array('jquery'), '1.0', true);
    wp_localize_script('JsExternal', 'PetitionAjax', [
        'url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('seg')
    ]);
}
add_action('admin_enqueue_scripts', 'GpRegisterJsGeneratePage');



// // savedata 

function GpgetAmazonIds()
{
    global $adminController;
    echo $adminController->GetAmazonIds();
}

add_action('wp_ajax_nopriv_get_data_amazon_ids', 'GpGetAmazonIds');
add_action('wp_ajax_get_data_amazon_ids', 'GpGetAmazonIds');

function GpDeleteAmazonId()
{
    global $adminController;
    echo $adminController->DeleteDataAmazonId();
}

add_action('wp_ajax_nopriv_delete_data_amazon_id', 'GpDeleteAmazonId');
add_action('wp_ajax_delete_data_amazon_id', 'GpDeleteAmazonId');



function GpSaveAmazonId()
{
    global $adminController;
    echo $adminController->SaveDataAmazonId();
}

add_action('wp_ajax_nopriv_save_data_amazon_id', 'GpSaveAmazonId');
add_action('wp_ajax_save_data_amazon_id', 'GpSaveAmazonId');

function SaveCreateAmazonProduct()
{

    global $adminController ;
    echo  $adminController->SaveCreateAmazonProduct();
   
}

add_action('wp_ajax_nopriv_save_create_amazon_product', 'SaveCreateAmazonProduct');
add_action('wp_ajax_save_create_amazon_product', 'SaveCreateAmazonProduct');




function GpGetShortCode($atts)
{
    global $adminController ;
    return  $adminController->GpGetShortCode($atts);
}

add_shortcode("GETPRODUCT", "GpGetShortCode");
