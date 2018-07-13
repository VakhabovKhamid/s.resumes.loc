<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Token $token
 */
?>
<h2><?= __('Add Token') ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Tokens'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create($token) ?>
                                    <div class="form-group">
                            <?= $this->Form->control('token', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('expire', ['class' => 'form-control']);?>
                        </div>

            <div class="text-right">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>
