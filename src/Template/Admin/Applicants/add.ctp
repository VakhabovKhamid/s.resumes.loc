<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<h2><?= __('Add Applicant') ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Applicants'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create($applicant) ?>
                                    <div class="form-group">
                            <?= $this->Form->control('latin_name', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('latin_surname', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('latin_patronym', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('sex', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('birth_date', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('address_country_id', ['options' => $dictionaryCountries, 'empty' => true, 'class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('address_region_id', ['options' => $dictionaryRegions, 'class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('address_district_id', ['options' => $dictionaryDistricts, 'class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('address_extended', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('education_level_id', ['options' => $dictionaryEducationLevels, 'class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('industry_id', ['options' => $dictionaryIndustries, 'class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('professional_skills', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('desirable_countries', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('undesirable_countries', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('is_archive', ['class' => 'form-control']);?>
                        </div>

            <div class="text-right">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>
