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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= __('Резюме') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('/css/resumes/defaultStyles.css') ?>
    <?= $this->Html->css('/css/resumes/icons.css') ?>
    <?= $this->Html->css('/css/resumes/fonts.css') ?>
    <?= $this->Html->css('/css/resumes/font-awesome.css') ?>
    <?= $this->Html->css('/css/resumes/jquery.fancybox.min.css') ?>
    <?= $this->Html->css('/css/resumes/multiple-select.css') ?>
    <?= $this->Html->css('/css/resumes/style.css') ?>
    <?= $this->Html->css('/css/resumes/media.css') ?>
    <?= $this->Html->css('/css/resumes/app.css') ?>

    <?= $this->Html->script('/js/resumes/jquery.js') ?>
    <?= $this->Html->script('/js/resumes/jquery.inputmask.bundle.min.js') ?>
    <?= $this->Html->script('/js/resumes/jquery.fancybox.min.js') ?>
    <?= $this->Html->script('/js/resumes/multiple-select.js') ?>
    <?= $this->Html->script('/js/resumes/script.js') ?>
    <?= $this->Html->script('/js/resumes/app.js') ?>

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
            <?php if ($this->Permissions->isAuthorized() && !$this->Permissions->isGuest() && $this->request->action != 'verifyCode'): ?>
            <div class="headerUserBlock">
              <div class="btnPersonalArea">
                <a class="PersonalAreaLink">
                  <div style="background-image: url(/images/userDefault.svg);" class="userAvatar"></div>
                  <div class="icon-arrow-min-bottom"></div>
                </a>
                <div class="subMenuPersonalArea">
                  <ul>
                    <li><a href="/logout"><?= __('Выйти') ?> <i class="fa fa-sign-out fa-fw"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
            <?php endif ?>
          </div>
        </div>
      </div>
      <!-- end #header-->
      <!-- start #content-->
      <div id="content">
        <div class="pagePadding">
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
          <div class="footerText left"><?= date('Y') ?>  <?= __('Министерство занятости и трудовых отношений Республики Узбекистан') ?></div>
          <div class="footerText right">
            <img src="/images/icons/tel-icon.svg" alt="" width="20" height="20">
            &nbsp;
            <?= __('Номер тех. поддержки') ?> <b>+998 (71) 000 00 00</b>
          </div>
          <div class="clear"></div>
        </div>
      </div>
    </div>
    <!-- end #footer-->
</body>
</html>
