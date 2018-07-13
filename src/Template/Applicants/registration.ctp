<div class="mainContainer minContainer1000">
    <div class="contentBlockBold">
        <div class="title-1 textCenter">Добавить резюме для работы за рубежом</div>
            <?= $this->Form->create($applicant, ['type'=>'file']) ?>
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
                                    <?= $this->Form->control('birth_date.day', ['options' => $birthDateDays, 'label' => false, 'class' => 'formField', 'empty' => 'День']); ?>
                                </div>
                            </div>
                            <div class="colp5-5">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.month', ['options' => $birthDateMonths, 'label' => false, 'class' => 'formField', 'empty' => 'Месяц']); ?>
                                </div>
                            </div>
                            <div class="colp5-4">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.year', ['options' => $birthDateYears, 'label' => false, 'class' => 'formField', 'empty' => 'Год']); ?>
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
                        <?= $this->Form->control('address_district_id', ['options' => [], 'label' => false, 'class' => 'formField', 'empty' => 'Выберите']); ?>
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
                            <?= $this->Form->control('industry_id', ['options' => $industries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Кем вы хотели бы работать</label>
                        <div class="field FiledMain">
                            <div class="row5">
                                <div class="colp5-10">
                                    <?= $this->Form->control('professional_skills', ['label' => false, 'class' => 'formField']); ?>
                                </div>
                                <div class="colp5-2">
                                    <button type="button" class="btn0 btn1 btnF btnAddField">+</button>
                                    <button type="button" class="btn0 btnRed btnF btnAddRemove">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Дополнительно</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Какой стране вы хотели бы работать</label>
                        <div class="field">
                            <?= $this->Form->control('desirable_countries', ['options' => $countries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Какой стране вы не хотели бы работать</label>
                        <div class="field">
                            <?= $this->Form->control('undesirable_countries', ['options' => $countries, 'label' => false, 'class' => 'formField jq-multiple-select', 'multiple' => true]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="formSubmit">
                <div class="checkboxCf">
                    <label>
                      <input type="checkbox"/><span>Вы соглашаетесь с условиями <a href="#">Публичной оферты</a></span>
                    </label>
                  </div>
                <div class="row15">
                    <div class="colp15-6"><a href="auth2.html" class="btn0 btnDefault btnBold btnBlock">Назад</a></div>
                    <div class="colp15-6">
                        <?= $this->Form->button(__('Submit'), ['class' => 'btn0 btnBlock btn1 btnBold']) ?>
                    </div>
                </div>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>