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
        <?= $seo->title ?>     
    </title>
    <meta name="description" content="<?= $seo->description ?>">
    <meta name="keywords" content="<?= $seo->keywords ?>">
    <link rel="shortcut icon" href="<?= $this->Url->build('/settings/'.$settings->favicon, ['fullBase' => true]) ?>" type="image/x-icon">
    <!--    JQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Hotjar Tracking Code for https://www.proftorg.in.ua/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1840619,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-168366090-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-168366090-1');
</script>
<!-- Global site tag (gtag.js) - Google Ads: 629453169 --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-629453169">
 window.dataLayer = window.dataLayer || []; 
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date()); gtag('config', 'AW-629453169'); 
</script>
  
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
