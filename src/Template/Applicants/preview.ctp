<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Applicant $applicant
 */
?>
<div class="mainContainer minContainer1000">
<div class="contentBlockBold">
  <div class="title-1 uppercase"><?= $applicant->latin_surname ?> <?= $applicant->latin_name ?></div>
  <div class="dateBlock">Дата создание: <strong><?= $applicant->created->format('d.m.Y') ?></strong></div>
  <hr/>
  <div class="resumeTable">
    <table>
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
        <td><?= $applicant->dictionary_region->name_ru_c ?></td>
      </tr>
      <tr>
        <th>Район:</th>
        <td><?= $applicant->dictionary_district->name_ru_c ?></td>
      </tr>
      <tr>
        <th>Уровень образование:</th>
        <td><?= $applicant->dictionary_education_level->name_ru_c ?></td>
      </tr>
      <tr>
        <th>Отрасль:</th>
        <td><?= $applicant->dictionary_industry->name_ru_c ?></td>
      </tr>
      <tr>
        <th>Профессия:</th>
        <td><?= $applicant->professional_skills?$applicant->professional_skills:'' ?></td>
      </tr>
      <tr>
        <th>Куда вы хотите:</th>
        <td><?= $applicant->dictionary_industry->name_ru_c ?></td>
      </tr>
      <tr>
        <th>Куда вы не хотите:</th>
        <td>Россия</td>
      </tr>
      <tr>
        <th>Телефон:</th>
        <td><?= $applicant->user->phone ?></td>
      </tr>
      <?php if (count($applicant->applicant_documents)): ?>
        <?php 
            $docLabels = [
                'photo' => 'Фото',
                'passport' => 'Копия паспорта',
            ];
        ?>
          <?php foreach ($applicant->applicant_documents as $doc): ?>
            <tr>
                <th><?= isset($docLabels[$doc->anchor])?$docLabels[$doc->anchor]:'' ?>:</th>
                <td>
                    <a href="<?= $doc->path ?>" class="fancybox"><img src="<?= $doc->path ?>" alt="" width="80"/></a>
                </td>
            </tr>
          <?php endforeach ?>
      <?php endif ?>
    </table>
  </div>
  <hr/>
  <div class="textRight">
    <a href="#" data-modal="#confirmDelete" class="btn0 btnRed">Удалить</a>
    &nbsp;
    <a href="form.html" class="btn0 btn1">Редактировать</a>
  </div>
</div>
</div>
