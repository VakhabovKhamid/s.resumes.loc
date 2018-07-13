<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<div class="mainContainer minContainer1000">
<div class="contentBlockBold">
  <div class="title-1 uppercase"><?= $applicant->latin_surname ?> <?= $applicant->latin_name ?></div>
  <div class="dateBlock">Дата создания: <strong><?= $applicant->created->format('d.m.Y') ?></strong></div>
  <hr/>
  <div class="resumeTable">
    <table>
      <tr>
        <th>Серийный номер паспорта:</th>
        <td><?= $applicant->document_seria_number ?></td>
      </tr>
      <tr>
        <th>Дата рождения:</th>
        <td><?= $applicant->birth_date->format('d.m.Y') ?></td>
      </tr>
      <tr>
        <th>Пол:</th>
        <td><?= isset($sexList[$applicant->sex])?$sexList[$applicant->sex]:'' ?></td>
      </tr>
      <tr>
        <th>Область:</th>
        <td><?= $applicant->dictionary_region->name ?></td>
      </tr>
      <tr>
        <th>Район:</th>
        <td><?= $applicant->dictionary_district->name ?></td>
      </tr>
      <tr>
        <th>Уровень образование:</th>
        <td><?= $applicant->dictionary_education_level->name ?></td>
      </tr>
      <tr>
        <th>Отрасль:</th>
          <?php
          $industries = array_map(function($industry){ return $industry->name; }, $applicant->industries);
          ?>
        <td><?= implode(', ', $industries) ?></td>
      </tr>
      <tr>
        <th>Профессия:</th>
        <td><?= $applicant->professional_skills?implode(', ', $applicant->professional_skills):'' ?></td>
      </tr>
      <tr>
        <th>В какой стране вы хотели бы работать:</th>
          <?php
          $desirable_countries = array_map(function($desirable_country){ return $desirable_country->name; }, $applicant->desirable_countries);
          ?>
        <td><?= implode(', ', $desirable_countries) ?></td>
      </tr>
      <tr>
        <th>В какой стране вы не хотели бы работать:</th>
          <?php
          $undesirable_countries = array_map(function($undesirable_country){ return $undesirable_country->name; }, $applicant->undesirable_countries);
          ?>
          <td><?= implode(', ', $undesirable_countries) ?></td>
      </tr>
      <tr>
        <th>Телефон:</th>
        <td><?= $applicant->user->token->phone ?></td>
      </tr>
    </table>
  </div>
  <hr/>
  <div class="textRight">
    <?= $this->Form->postLink('Удалить', ['action' => 'delete'], ['confirm' => __('Are you sure you want to delete?'), 'escape' => false, 'class' => 'btn0 btnRed']) ?>
    &nbsp;
    <?= $this->Html->link('Редактировать', ['action' => 'edit'], ['class' => 'btn0 btn1']) ?>
  </div>
</div>
</div>
