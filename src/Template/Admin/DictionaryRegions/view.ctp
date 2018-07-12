<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\DictionaryRegion $dictionaryRegion
 */
?>

<h2><?= __('Dictionary Region') ?> #<?= h($dictionaryRegion->id) ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Dictionary Regions'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit Dictionary Region'), ['action' => 'edit', $dictionaryRegion->id],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('New Dictionary Region'), ['action' => 'add'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th scope="row"><?= __('Name Uz C') ?></th>
        <td><?= h($dictionaryRegion->name_uz_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Uz L') ?></th>
        <td><?= h($dictionaryRegion->name_uz_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Ru C') ?></th>
        <td><?= h($dictionaryRegion->name_ru_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name En L') ?></th>
        <td><?= h($dictionaryRegion->name_en_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Qr C') ?></th>
        <td><?= h($dictionaryRegion->name_qr_c) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name Qr L') ?></th>
        <td><?= h($dictionaryRegion->name_qr_l) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Is Active') ?></th>
        <td><?= h($dictionaryRegion->is_active) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($dictionaryRegion->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= $this->Number->format($dictionaryRegion->created_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified By') ?></th>
        <td><?= $this->Number->format($dictionaryRegion->modified_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($dictionaryRegion->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($dictionaryRegion->modified) ?></td>
    </tr>
</table>
<div class="clearfix">
    <div class="pull-left">
        <?= $this->Form->postLink(__('Delete Dictionary Region'), ['action' => 'delete', $dictionaryRegion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dictionaryRegion->id), 'class' => 'btn btn-danger']) ?> 
    </div>
</div>