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
        <?= $seo->title; ?>
    </title>
    <meta name="description" content="<?= $seo->description; ?>">
    <meta name="keywords" content="?= $seo->description; ?>">
    <?= $this->Html->meta('icon') ?>
    <!--    JQuery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!--        Font Awesome    -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
              
    <?= $this->Html->css('style.css') ?>


  <?=  $this->Html->script('bootstrap/dist/js/bootstrap.min.js'); ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
</head>
<body>

<?= $this->element('header'); ?>

<?= $this->Flash->render() ?>

<?= $this->fetch('content') ?>

<?= $this->element('footer'); ?>
                  <?= $this->fetch('script') ?>
</body>
</html>
