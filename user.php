<!DOCTYPE html>
<html lang="en">
    <head>        
        <?php
        session_start();
        include './include/inc_meta_tags.html';
        include './include/inc_css.html';
        require_once './poo/bootstrap.php';
        ?>
        <title><?php echo TITRE_SITE ?></title>
    </head>
    <body>
        <div id="fb-root"></div>           
        <?php
        include './sections/header_section.php';
        include './sections/player_section.php';
        include './include/inc_footer.html';
        include './include/inc_js.html'
        ?>
    </body>
</html>