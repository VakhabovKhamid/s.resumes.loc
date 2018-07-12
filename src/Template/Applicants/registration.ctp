<div class="mainContainer minContainer1000">
    <div class="contentBlockBold">
        <div class="title-1 textCenter">Добавить резюме для работы за рубежом</div>
            <?= $this->Form->create($applicant, ['type'=>'file']) ?>
            <div class="title-3">Персональная информация</div>
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
                                    <?= $this->Form->control('birth_date.day', ['options' => $birthDateDays, 'label' => false, 'class' => 'formField']); ?>
                                </div>
                            </div>
                            <div class="colp5-5">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.month', ['options' => $birthDateMonths, 'label' => false, 'class' => 'formField']); ?>
                                </div>
                            </div>
                            <div class="colp5-4">
                                <div class="field">
                                    <?= $this->Form->control('birth_date.year', ['options' => $birthDateYears, 'label' => false, 'class' => 'formField']); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Пол</label>
                        <div class="field">
                            <?= $this->Form->control('sex', ['options' => $sexList, 'label' => false, 'class' => 'formField']); ?>
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
                        <?= $this->Form->control('address_region_id', ['options' => $regions, 'label' => false, 'class' => 'formField']); ?>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Район</label>
                        <?= $this->Form->control('address_district_id', ['options' => $districts, 'label' => false, 'class' => 'formField']); ?>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Образование</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel required">Уровень образование</label>
                        <?= $this->Form->control('education_level_id', ['options' => $educationLevels, 'label' => false, 'class' => 'formField']); ?>
                    </div>
                </div>
            </div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Отрасль</label>
                        <div class="field">
                            <?= $this->Form->control('industry_id', ['options' => $industries, 'label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Профессия</label>
                        <div class="field">
                            <?= $this->Form->control('professional_skills', ['label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Дополнительно</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Куда вы хотите</label>
                        <div class="field">
                            <?= $this->Form->control('desirable_countries', ['options' => $countries, 'label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Куда вы не хотите</label>
                        <div class="field">
                            <?= $this->Form->control('undesirable_countries', ['options' => $countries, 'label' => false, 'class' => 'formField']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="title-3">Файлы</div>
            <div class="row15">
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Добавить фото</label>
                        <div class="field">
                            <?= $this->Form->control('applicant_documents.0.name', ['type' => 'file', 'label' => false, 'class' => 'formField']); ?>
                            <?= $this->Form->control('applicant_documents.0.anchor', ['type' => 'hidden', 'value'=>'photo']); ?>
                        </div>
                    </div>
                </div>
                <div class="colp15-6">
                    <div class="formControl">
                        <label class="formLabel">Копия паспорта</label>
                        <div class="field">
                            <?= $this->Form->control('applicant_documents.1.name', ['type' => 'file', 'label' => false, 'class' => 'formField']); ?>
                            <?= $this->Form->control('applicant_documents.1.anchor', ['type' => 'hidden', 'value'=>'passport']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="formSubmit">
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