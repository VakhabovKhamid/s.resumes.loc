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
<html>
<head>
    <?= $this->Html->charset() ?>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('/css/resumes/defaultStyles.css') ?>
    <?= $this->Html->css('/css/resumes/icons.css') ?>
    <?= $this->Html->css('/css/resumes/fonts.css') ?>
    <?= $this->Html->css('/css/resumes/font-awesome.css') ?>
    <?= $this->Html->css('/css/resumes/jquery.fancybox.min.css') ?>
    <?= $this->Html->css('/css/resumes/style.css') ?>
    <?= $this->Html->css('/css/resumes/media.css') ?>

    <?= $this->Html->script('/js/resumes/jquery.js') ?>
    <?= $this->Html->script('/js/resumes/jquery.maskedinput.min.js') ?>
    <?= $this->Html->script('/js/resumes/jquery.fancybox.min.js') ?>
    <?= $this->Html->script('/js/resumes/script.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
    <!-- start #mainWrap-->
    <div id="mainWrap">
      <!-- start #header-->
      <div id="header">
        <div class="mainContainer">
          <div class="header">
            <div class="logo"><a href="/"><img src="/images/gerb.svg" alt=""/><span class="logoText">Единая национальная<br> система труда</span></a></div>
            <div class="headerUserBlock">
              <div class="hUserName">Дата:<span><?= date('d.m.Y') ?></span></div>
            </div>
          </div>
        </div>
      </div>
      <!-- end #header-->
      <!-- start #content-->
      <div id="content">
        <div class="pagePadding">
            <div class="mainContainer">
            <?= $this->Flash->render() ?>
            </div>
            <?= $this->fetch('content') ?>
        </div>
      </div>
      <!-- end #content-->
    </div>
    <!-- end #mainWrap-->
    <!-- start #footer-->
    <div id="footer">
      <div class="mainContainer">
        <div class="footer">
          <div class="footerText textCenter"><?= date('Y') ?> Министерство занятости и трудовых отношений Республики Узбекистан</div>
        </div>
      </div>
    </div>
    <!-- end #footer-->
</body>
</html>