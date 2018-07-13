<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?= $this->fetch('title') ?>
        </title>
        <?= $this->Html->meta('icon') ?>

        <?= $this->Html->css('/css/admin/bootstrap.min.css') ?>
        <?= $this->Html->css('/css/admin/metisMenu.min.css') ?>
        <?= $this->Html->css('/css/admin/startmin.css') ?>
        <?= $this->Html->css('/css/admin/font-awesome.min.css') ?>
        <?= $this->Html->css('/css/admin/bootstrap-toggle.min.css') ?>
        <?= $this->Html->css('/css/admin/app.css') ?>

        <?= $this->Html->script('/js/admin/jquery.min.js') ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="wrapper">
            <?= $this->element('navmenu') ?>

            <!-- Page Content -->
            <div id="page-wrapper">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->

        <?= $this->Html->script('/js/admin/bootstrap-toggle.min.js') ?>
        <?= $this->Html->script('/js/admin/bootstrap.min.js') ?>
        <?= $this->Html->script('/js/admin/metisMenu.min.js') ?>
        <?= $this->Html->script('/js/admin/startmin.js') ?>
        <?= $this->Html->script('/js/admin/app.js') ?>
    </body>
</html>