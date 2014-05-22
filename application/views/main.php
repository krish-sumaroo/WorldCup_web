<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php echo $view ?>
     <script src="<?php echo base_url(); ?>public/js/jquery.js"></script>   
     <script type="text/javascript" src="<?php echo base_url(); ?>public/bootstrap/bootstrap.js"></script>
     <?php if(isset($js) && count($js) > 0) : ?>
        <?php foreach($js as $jsFile) : ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/<?php echo $jsFile?>.js"></script>
        <?php endforeach; ?>    
     <?php endif ?>   
    </body>
</html>
