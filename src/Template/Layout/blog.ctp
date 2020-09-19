<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html >
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $blog->title ?>     
    </title>
    <meta name="description" content="<?= $blog->description ?>">
    <meta name="keywords" content="<?= $blog->keywords ?>">
    <link rel="shortcut icon" href="<?= $this->Url->build('/settings/'.$settings->favicon, ['fullBase' => true]) ?>" type="image/x-icon">
    <!--    JQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600&display=swap" rel="stylesheet">


  
   <!-- <?= $this->Html->css('bootstrap.min.css') ?> -->
   <link href="   https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body >
<div class="background_grey"></div>
<?= $this->element('header'); ?>

<?= $this->Flash->render() ?>

<?= $this->fetch('content') ?>

<?= $this->element('footer'); ?>
<?= $this->element('bascket'); ?>
<script>
    var currency_url = '<?= $baseUrl ?>';
    //console.log("erg");
    <?php  if (isset($_SESSION['cart'])){  ?>
        var cart = <?= json_encode($_SESSION['cart']); ?>;
    <?php   } else { ?>
        var cart;
    <?php   }  ?>        
</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<?= $this->Html->script('landing.js?v=123'); ?>

    <?= $this->fetch('script') ?>

</body>
</html>
