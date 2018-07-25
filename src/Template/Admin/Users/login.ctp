<?php
/**
 * @var \App\View\AppView $this
 */
?>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= __('Please enter your username and password') ?></h3>
            </div>
            <div class="panel-body">
                <?= $this->Flash->render('auth') ?>
                <?= $this->Form->create() ?>
                    <fieldset>
                        <div class="form-group">
                            <?= $this->Form->control('username', ['class'=>'form-control']) ?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('password', ['class'=>'form-control']) ?>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <?= $this->Form->button(__('Login'), ['class'=>'btn btn-lg btn-success btn-block']); ?>
                    </fieldset>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>