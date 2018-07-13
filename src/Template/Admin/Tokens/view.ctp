<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Token $token
 */
?>

<h2><?= __('Token') ?> #<?= h($token->id) ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Tokens'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit Token'), ['action' => 'edit', $token->id],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('New Token'), ['action' => 'add'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($token->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= $this->Number->format($token->created_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Expire') ?></th>
        <td><?= h($token->expire) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($token->created) ?></td>
    </tr>
</table>
<div class="clearfix">
    <div class="pull-left">
        <?= $this->Form->postLink(__('Delete Token'), ['action' => 'delete', $token->id], ['confirm' => __('Are you sure you want to delete # {0}?', $token->id), 'class' => 'btn btn-danger']) ?> 
    </div>
</div>