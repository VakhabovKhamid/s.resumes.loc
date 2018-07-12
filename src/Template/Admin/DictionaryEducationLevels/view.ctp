<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DictionaryEducationLevel $dictionaryEducationLevel
 */
?>

<h2><?= __('Dictionary Education Level') ?> #<?= h($dictionaryEducationLevel->id) ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Dictionary Education Levels'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit Dictionary Education Level'), ['action' => 'edit', $dictionaryEducationLevel->id],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('New Dictionary Education Level'), ['action' => 'add'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th scope="row"><?= __('Name Uz C') ?></th>
        <td><?= h($dictionaryEducationLevel->name_uz_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Uz L') ?></th>
        <td><?= h($dictionaryEducationLevel->name_uz_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Ru C') ?></th>
        <td><?= h($dictionaryEducationLevel->name_ru_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name En L') ?></th>
        <td><?= h($dictionaryEducationLevel->name_en_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Qr C') ?></th>
        <td><?= h($dictionaryEducationLevel->name_qr_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Qr L') ?></th>
        <td><?= h($dictionaryEducationLevel->name_qr_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Is Active') ?></th>
        <td><?= h($dictionaryEducationLevel->is_active) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($dictionaryEducationLevel->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= $this->Number->format($dictionaryEducationLevel->created_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified By') ?></th>
        <td><?= $this->Number->format($dictionaryEducationLevel->modified_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($dictionaryEducationLevel->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($dictionaryEducationLevel->modified) ?></td>
    </tr>
</table>
<div class="clearfix">
    <div class="pull-left">
        <?= $this->Form->postLink(__('Delete Dictionary Education Level'), ['action' => 'delete', $dictionaryEducationLevel->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dictionaryEducationLevel->id), 'class' => 'btn btn-danger']) ?> 
    </div>
</div>