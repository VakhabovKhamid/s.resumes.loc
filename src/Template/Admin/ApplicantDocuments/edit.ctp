<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ApplicantDocument $applicantDocument
 */
?>
<h2><?= __('Edit Applicant Document') ?></h2>
<hr>
<div class="clearfix">
    <div class="pull-left">
        <div class="btn-group group-control">
            <?= $this->Html->link(__('List Applicant Documents'), ['action' => 'index'],['escape' => false,'class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <?= $this->Form->create($applicantDocument) ?>
                                    <div class="form-group">
                            <?= $this->Form->control('applicant_id', ['options' => $applicants, 'class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('anchor', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('name', ['class' => 'form-control']);?>
                        </div>
                        <div class="form-group">
                            <?= $this->Form->control('path', ['class' => 'form-control']);?>
                        </div>

            <div class="text-right">
                <?= $this->Form->button(__('Submit'), ['class' => 'btn btn-success']) ?>
            </div>

        <?= $this->Form->end() ?>
    </div>
</div>
