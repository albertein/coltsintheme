<? 
   include(coltsin_get_path('/inc/Mustache.php'));
   $mustache = new Mustache;
   $header_template = coltsin_get_template('header');
   $header_data = array(
       'charset' => get_bloginfo('charset'),
       'blog-name' => get_bloginfo('name'),
       'blog-description' => get_bloginfo('description')
   );
   echo $mustache->render($header_template, $header_data);
?>