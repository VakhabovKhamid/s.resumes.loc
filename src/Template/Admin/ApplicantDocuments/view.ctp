<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantDocument $applicantDocument
 */
?>

<h2><?= __('Applicant Document') ?> #<?= h($applicantDocument->name) ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Applicant Documents'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit Applicant Document'), ['action' => 'edit', $applicantDocument->id],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('New Applicant Document'), ['action' => 'add'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th scope="row"><?= __('Applicant') ?></th>
        <td><?= $applicantDocument->has('applicant') ? $this->Html->link($applicantDocument->applicant->id, ['controller' => 'Applicants', 'action' => 'view', $applicantDocument->applicant->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Anchor') ?></th>
        <td><?= h($applicantDocument->anchor) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Name') ?></th>
        <td><?= h($applicantDocument->name) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Path') ?></th>
        <td><?= h($applicantDocument->path) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($applicantDocument->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= $this->Number->format($applicantDocument->created_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified By') ?></th>
        <td><?= $this->Number->format($applicantDocument->modified_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($applicantDocument->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($applicantDocument->modified) ?></td>
    </tr>
</table>
<div class="clearfix">
    <div class="pull-left">
        <?= $this->Form->postLink(__('Delete Applicant Document'), ['action' => 'delete', $applicantDocument->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicantDocument->id), 'class' => 'btn btn-danger']) ?> 
    </div>
</div>