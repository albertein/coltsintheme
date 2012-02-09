<?
function coltsin_get_path($filename) {
    return get_template_directory() . '/' . $filename;
}

function coltsin_get_template($template_name) {
    return file_get_contents(coltsin_get_path("templates/$template_name.html"));
}
  
function coltsin_get_buffer($action) {
    ob_start();
    $action();
    return ob_get_clean();  
}
?>