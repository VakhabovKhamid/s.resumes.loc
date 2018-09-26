<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 02.07.18
 * Time: 13:20
 */

namespace App\Model\Entity;


use Cake\Core\Configure;
use Cake\I18n\I18n;

trait LocaliseTrait
{
    private $locales = [
        // 'en_US' => 'en_l',
        'uz_CL' => 'uz_c',
        'uz_LN' => 'uz_l',
        'ru_RU' => 'ru_c',
        'qr_QR' => 'qr_c' // ISO 639-2/3
    ];

    private $languagesLocales = [
        // 'en' => 'en_US',
        'uz-cl' => 'uz_CL',
        'uz-ln' => 'uz_LN',
        'ru'    => 'ru_RU',
        'qr'    => 'qr_QR'
    ];

    private $languages = [
        // 'en' => 'English',
        'uz-cl' => 'Узбекча',
        'uz-ln' => 'O’zbekcha',
        'ru'    => 'Русский',
        'qr'    => 'Қарақалпақша'
    ];

    /**
     * @return string
     */
    private function getLanguageByLocale()
    {
        $locale = I18n::getLocale();

        if(!in_array($locale, array_keys($this->locales))) {
            throw new \BadMethodCallException('Invalid locale value');
        }

        return $this->locales[$locale];
    }

    /**
     * @param string $shortLanguage
     * @return void
     */
    public function setDefaultLocale($shortLanguage)
    {
        if (!in_array($shortLanguage, array_keys($this->languagesLocales))) {
            return;
        }
        $locale = $this->languagesLocales[$shortLanguage];
        I18n::setLocale($locale);
        $this->getRequest()->getSession()->write("System.language", $locale);
    }
}