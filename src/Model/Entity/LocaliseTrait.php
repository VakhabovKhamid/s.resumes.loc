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
        'ru' => 'ru_c',
        'en' => 'en_l',
        'uz' => 'uz_l',
        'ru_RU' => 'ru_c',
        'en_US' => 'en_l',
        'en_GB' => 'en_L',
        'uz_Cyrl' => 'uz_c',
        'uz_Latn' => 'uz_l',
        'uz_Cyrl_UZ' => 'uz_c',
        'uz_Latn_UZ' => 'uz_l',
        'kaa' => 'kaa' // ISO 639-2/3
    ];

    private $languagesLocales = [
        'ru' => 'ru_RU',
        'en' => 'en_US',
        'uz-cyrl' => 'uz_Cyrl',
        'uz-latn' => 'uz_Latn',
        'kaa' => 'kaa'
    ];

    /**
     * @param string $locale
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