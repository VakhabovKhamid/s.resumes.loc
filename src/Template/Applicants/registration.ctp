<div class="mainContainer minContainer1000">
    <div class="contentBlockBold">
        <div class="title-1 textCenter">Добавить резюме для работы за рубежом</div>
            <?= $this->Form->create($applicant, ['type'=>'file', 'id' => isset($applicant->id)?'registration-form-edit':'registration-form']) ?>
            <div class="title-3">Персональная информация</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Серийный номер паспорта</label>
                        <div class="field">
                            <?= $this->Form->control('document_seria_number', ['label' => false, 'class' => 'formField series_doc', 'placeholder' => 'AA0000000']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Фамилия</label>
                        <div class="field">
                            <?= $this->Form->control('latin_surname', ['label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Имя</label>
                        <div class="field">
                            <?= $this->Form->control('latin_name', ['label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Дата рождения</label>
                        <div class="row5">
                            <div class="colp5-3">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.day', ['value' => $applicant->birth_date?$applicant->birth_date->format('j'):'', 'options' => $birthDateDays, 'label' => false, 'class' => 'formField', 'empty' => 'День']); ?>
                                </div>
                            </div>
                            <div class="colp5-5">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.month', ['value' => $applicant->birth_date?$applicant->birth_date->format('n'):'', 'options' => $birthDateMonths, 'label' => false, 'class' => 'formField', 'empty' => 'Месяц']); ?>
                                </div>
                            </div>
                            <div class="colp5-4">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.year', ['value' => $applicant->birth_date?$applicant->birth_date->format('Y'):'', 'options' => $birthDateYears, 'label' => false, 'class' => 'formField', 'empty' => 'Год']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Пол</label>
                        <div class="field">
                            <?= $this->Form->control('sex', ['options' => $sexList, 'label' => false, 'class' => 'formField', 'empty' => 'Выберите']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Адрес</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Область</label>
                        <?= $this->Form->control('address_region_id', ['options' => $regions, 'label' => false, 'class' => 'formField', 'empty' => 'Выберите']); ?>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Район</label>
                        <?= $this->Form->control('address_district_id', ['options' => isset($districts)?$districts:[], 'label' => false, 'class' => 'formField', 'empty' => 'Выберите']); ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Образование</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Уровень образование</label>
                        <?= $this->Form->control('education_level_id', ['options' => $educationLevels, 'label' => false, 'class' => 'formField', 'empty' => 'Выберите']); ?>
                    </div>
                    <div class="formControl">
                        <label class="formLabel">Отрасль</label>
                        <div class="field">
                            <?= $this->Form->control('industries._ids', ['options' => $industries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Кем вы хотели бы работать</label>
                        <div class="field FiledMain" data-leng='<?= isset($applicant->id)?count($applicant->professional_skills):'1' ?>'>
                            <div class="row5">
                                <div class="colp5-10">
                                    <?= $this->Form->control('professional_skills[]', ['value' => isset($applicant->professional_skills[0])?$applicant->professional_skills[0]:'','label' => false, 'class' => 'formField']); ?>
                                </div>
                                <div class="colp5-2">
                                    <button type="button" class="btn0 btn1 btnF btnAddField">+</button>
                                    <button type="button" class="btn0 btnRed btnF btnAddRemove">-</button>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($applicant->id) && count($applicant->professional_skills) > 0): ?>
                            <?php foreach ($applicant->professional_skills as $key => $value): ?>
                                <?php if ($key != 0): ?>
                                <div class="field FiledClone">
                                    <div class="row5">
                                        <div class="colp5-10">
                                            <?= $this->Form->control('professional_skills[]', ['value' => $value,'label' => false, 'class' => 'formField']); ?>
                                        </div>
                                        <div class="colp5-2">
                                            <button type="button" class="btn0 btn1 btnF btnAddField">+</button>
                                            <button type="button" class="btn0 btnRed btnF btnAddRemove">-</button>
                                        </div>
                                    </div>
                                </div>
                                <?php endif ?>
                            <?php endforeach ?>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Дополнительно</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">В какой стране вы хотели бы работать</label>
                        <div class="field">
                            <?= $this->Form->control('desirable_countries._ids', ['options' => $countries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">В какой стране вы не хотели бы работать</label>
                        <div class="field">
                            <?= $this->Form->control('undesirable_countries._ids', ['options' => $countries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="formSubmit">
                <?php if (!isset($applicant->id)): ?>
                <div class="checkboxCf">
                    <label>
                      <input id="checkPublicOffer" type="checkbox"/>
                      <span>Вы соглашаетесь с условиями <a href="/static-page.html" target="_blank">Публичной оферты</a></span>
                    </label>
                    <p class="error-text">Пожалуйста отметьте что вы согласно с условиями Публичной оферты</p>
                </div>
                <?php endif ?>
                <div class="row15">
                    <div class="colp15-6">
                        <?php if (isset($applicant->id)): ?>
                            <?= $this->Html->link('Назад', ['action' => 'preview'],['class' => 'btn0 btnDefault btnBold btnBlock']) ?>
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