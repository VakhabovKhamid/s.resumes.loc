<div class="mainContainer minContainer1000">
    <div class="contentBlockBold">
        <div class="title-1 textCenter"><?= __('Добавить резюме для работы за рубежом') ?></div>
            <div class="alert alert-danger hide" id="serverErrorSoliq"><?= __('Данный момент нет связи с сервисом soliq.uz. Заполните поля в ручную или попробуйте еще раз.') ?></div>
            <?= $this->Form->create($applicant, ['type'=>'file', 'id' => isset($applicant->id)?'registration-form-edit':'registration-form']) ?>
            <div class="title-3"><?= __('Персональная информация')?></div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Серийный номер паспорта')?></label>
                        <div class="field">
                            <?= $this->Form->control('document_seria_number', ['label' => false, 'class' => 'formField series_doc', 'placeholder' => 'AA0000000']); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">&nbsp;</label>
                        <div class="field">
                            <button class="btn0 btn1 btnBlock btnBold" id='importDataEmployee' type="button"><?= __('Заполнить форму') ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Фамилия')?></label>
                        <div class="field">
                            <?= $this->Form->control('latin_surname', ['label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Имя')?></label>
                        <div class="field">
                            <?= $this->Form->control('latin_name', ['label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Дата рождения')?></label>
                        <div class="field">
                            <?= $this->Form->control('birth_date', ['type' => 'text','label' => false, 'class' => 'formField jq-date-field', 'placeholder' => 'dd-mm-yyyy', 'value' => $applicant->birth_date?$applicant->birth_date->format('d-m-Y'):'']); ?>
                        </div>
                        <?php /* ?>
                        <div class="row5">
                            <div class="colp5-3">
                                <div class="field disabled">
                                    <?= $this->Form->control('birth_date.day', ['value' => $applicant->birth_date?$applicant->birth_date->format('j'):'', 'options' => $birthDateDays, 'label' => false, 'class' => 'formField', 'empty' => 'День']); ?>
                                </div>
                            </div>
                            <div class="colp5-5">
                                <div class="field disabled">
                                    <?= $this->Form->control('birth_date.month', ['value' => $applicant->birth_date?$applicant->birth_date->format('n'):'', 'options' => $birthDateMonths, 'label' => false, 'class' => 'formField', 'empty' => 'Месяц']); ?>
                                </div>
                            </div>
                            <div class="colp5-4">
                                <div class="field disabled">
                                    <?= $this->Form->control('birth_date.year', ['value' => $applicant->birth_date?$applicant->birth_date->format('Y'):'', 'options' => $birthDateYears, 'label' => false, 'class' => 'formField', 'empty' => 'Год']); ?>
                                </div>
                            </div>
                        </div>
                        <?php */ ?>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Пол')?></label>
                        <div class="field">
                            <?= $this->Form->control('sex', ['options' => $sexList, 'label' => false, 'class' => 'formField', 'empty' => __('Выберите')]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3"><?= __('Адрес')?></div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Область')?></label>
                        <?= $this->Form->control('address_region_id', ['options' => $regions, 'label' => false, 'class' => 'formField', 'empty' => __('Выберите')]); ?>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required"><?= __('Район')?></label>
                        <?= $this->Form->control('address_district_id', ['options' => isset($districts)?$districts:[], 'label' => false, 'class' => 'formField', 'empty' => __('Выберите')]); ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3"><?= __('Образование')?></div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel"><?= __('Уровень образование')?></label>
                        <?= $this->Form->control('education_level_id', ['options' => $educationLevels, 'label' => false, 'class' => 'formField', 'empty' => __('Выберите')]); ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3"><?= __('Требования к работе')?></div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel"><?= __('Отрасль')?></label>
                        <div class="field">
                            <?= $this->Form->control('industries._ids', ['options' => $industries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel"><?= __('Кем вы хотели бы работать')?></label>
                        <div class="wrapCloneFields">
                            <div class="field FiledMain" data-leng='<?= isset($applicant->id)?count($applicant->professional_skills):'1' ?>'>
                                <?= $this->Form->control('professional_skills[]', ['value' => isset($applicant->professional_skills[0])?$applicant->professional_skills[0]:'','label' => false, 'class' => 'formField']); ?>
                                <div class="textRight">
                                    <a href="#" class="btnAddRemove dec-n"><i class="fa fa-trash-o"></i> <?= __('Удалить')?></a>
                                </div>
                            </div>
                            <?php if (isset($applicant->id) && count($applicant->professional_skills) > 0): ?>
                                <?php foreach ($applicant->professional_skills as $key => $value): ?>
                                    <?php if ($key != 0): ?>
                                    <div class="field FiledClone">
                                        <?= $this->Form->control('professional_skills[]', ['value' => $value,'label' => false, 'class' => 'formField']); ?>
                                        <div class="textRight">
                                            <a href="#" class="btnAddRemove dec-n"><i class="fa fa-trash-o"></i> <?= __('Удалить')?></a>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endif ?>
                            <a href="#" class="btnAddField dec-n">+ <?= __('Добавить еще')?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel"><?= __('В какой стране вы хотели бы работать')?></label>
                        <div class="field">
                            <?= $this->Form->control('desirable_countries._ids', ['options' => $countries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel"><?= __('В какой стране вы не хотели бы работать')?></label>
                        <div class="field">
                            <?= $this->Form->control('undesirable_countries._ids', ['options' => $countries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="formSubmit">
                <?php if (!isset($applicant->id)): ?>
                <div class="checkboxCf textRight">
                    <label>
                      <input id="checkPublicOffer" type="checkbox"/>
                      <span><?= __('Вы соглашаетесь с условиями')?> <a href="/static-page.html" target="_blank"><?= __('Публичной оферты')?></a></span>
                    </label>
                    <p class="error-text"><?= __('Пожалуйста отметьте что вы согласно с условиями Публичной оферты')?></p>
                </div>
                <?php endif ?>
                <div class="row15">
                    <div class="colp15-6">
                        <?php if (isset($applicant->id)): ?>
                            <?= $this->Html->link(__('Назад'), ['action' => 'preview'],['class' => 'btn0 btnDefault btnBold btnBlock']) ?>
                        <?php else: ?>
                            &nbsp;
                        <?php endif ?>
                    </div>
                    <div class="colp15-6">
                        <?= $this->Form->button(__('Сохранить'), ['class' => 'btn0 btnBlock btn1 btnBold']) ?>
                    </div>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>