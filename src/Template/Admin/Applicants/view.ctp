<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>

<h2><?= __('Applicant') ?> #<?= h($applicant->id) ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Applicants'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('Edit Applicant'), ['action' => 'edit', $applicant->id],['escape' => false,'class' => 'btn btn-default']) ?>
            <?= $this->Html->link(__('New Applicant'), ['action' => 'add'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th scope="row"><?= __('Latin Name') ?></th>
        <td><?= h($applicant->latin_name) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Latin Surname') ?></th>
        <td><?= h($applicant->latin_surname) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Latin Patronym') ?></th>
        <td><?= h($applicant->latin_patronym) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Sex') ?></th>
        <td><?= h($applicant->sex) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Dictionary Country') ?></th>
        <td><?= $applicant->has('dictionary_country') ? $this->Html->link($applicant->dictionary_country->id, ['controller' => 'DictionaryCountries', 'action' => 'view', $applicant->dictionary_country->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Dictionary Region') ?></th>
        <td><?= $applicant->has('dictionary_region') ? $this->Html->link($applicant->dictionary_region->id, ['controller' => 'DictionaryRegions', 'action' => 'view', $applicant->dictionary_region->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Dictionary District') ?></th>
        <td><?= $applicant->has('dictionary_district') ? $this->Html->link($applicant->dictionary_district->id, ['controller' => 'DictionaryDistricts', 'action' => 'view', $applicant->dictionary_district->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Address Extended') ?></th>
        <td><?= h($applicant->address_extended) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Dictionary Education Level') ?></th>
        <td><?= $applicant->has('dictionary_education_level') ? $this->Html->link($applicant->dictionary_education_level->id, ['controller' => 'DictionaryEducationLevels', 'action' => 'view', $applicant->dictionary_education_level->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Dictionary Industry') ?></th>
        <td><?= $applicant->has('dictionary_industry') ? $this->Html->link($applicant->dictionary_industry->id, ['controller' => 'DictionaryIndustries', 'action' => 'view', $applicant->dictionary_industry->id]) : '' ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Professional Skills') ?></th>
        <td><?= h($applicant->professional_skills) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Is Archive') ?></th>
        <td><?= h($applicant->is_archive) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Id') ?></th>
        <td><?= $this->Number->format($applicant->id) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created By') ?></th>
        <td><?= $this->Number->format($applicant->created_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified By') ?></th>
        <td><?= $this->Number->format($applicant->modified_by) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Birth Date') ?></th>
        <td><?= h($applicant->birth_date) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Created') ?></th>
        <td><?= h($applicant->created) ?></td>
    </tr>
    <tr>
        <th scope="row"><?= __('Modified') ?></th>
        <td><?= h($applicant->modified) ?></td>
    </tr>
</table>
<div class="clearfix">
    <div class="pull-left">
        <?= $this->Form->postLink(__('Delete Applicant'), ['action' => 'delete', $applicant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $applicant->id), 'class' => 'btn btn-danger']) ?> 
    </div>
</div>