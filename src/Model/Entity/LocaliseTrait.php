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
        'ru_RU' => 'ru_c',
        'en_US' => 'en_l',
        'en_GB' => 'en_L',
        'uz_Cyrl' => 'uz_c',
        'uz_Latn' => 'uz_l',
        'uz_Cyrl_UZ' => 'uz_c',
        'uz_Latn_UZ' => 'uz_l',
        'kaa' => 'kaa' // ISO 639-2/3
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
}