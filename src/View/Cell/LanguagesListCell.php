<?php
namespace App\View\Cell;

use App\Model\Entity\Application;
use App\Model\Entity\ForeignApplication;
use Cake\View\Cell;
use App\Model\Entity\LocaliseTrait;

/**
 * ApplicationsSidebar cell
 */
class LanguagesListCell extends Cell
{
    use LocaliseTrait;

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {

    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display()
    {
        $currentLang = $this->request->session()->read('System.language');

        $currentLang = array_search($currentLang, $this->languagesLocales);
        // dd($currentLang);
        $languages = $this->languages;
        $this->set(compact('languages', 'currentLang'));
    }

}
