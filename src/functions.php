<?
function coltsin_get_path($filename) {
    return get_template_directory() . '/' . $filename;
}

function coltsin_get_template($template_name) {
    return file_get_contents(coltsin_get_path($template_name . ".html"));
}
?>