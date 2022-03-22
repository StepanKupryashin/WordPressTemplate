<!DOCTYPE html>
<html lang="ru">
<head>
    <?php wp_head();?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
get_header();
?>
<main>
    <div class="content">
        <h1>CONTENT</h1>
        <?php the_content();?>
    </div>
    <?php
    get_sidebar();
    ?>
    <div class="delimetr"></div>
    <?php
    get_footer();
    ?>
</main>