"# getproduct" 
1.  Add file function of your theme the next code:

//registe bootstrap for principal view
function GpViewRegisterBootstrapCSS($hook)
{
    wp_enqueue_style('bootstrapCss', get_template_directory_uri() .'/assets/bootstrap-5.2.3-dist/css/bootstrap.min.css');
    wp_enqueue_style('bootstrapIconsCss', get_template_directory_uri() .'/assets/bootstrap-5.2.3-dist/css/font/bootstrap-icons.min.css');
}
add_action('wp_enqueue_scripts', 'GpViewRegisterBootstrapCSS');



// //Register js own

function GpViewRegisterBootstrapJs($hook)
{
    wp_enqueue_script('bootstrapJs', get_template_directory_uri() .'/assets/bootstrap-5.2.3-dist/js/bootstrap.bundle.js', array('jquery'), "5.2.3", true);
}
add_action('wp_enqueue_scripts', 'GpViewRegisterBootstrapJs');



