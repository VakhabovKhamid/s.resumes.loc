<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 03.07.18
 * Time: 17:05
 */

namespace App\Controller\Component;


use Cake\Controller\Component\FlashComponent;

class DetailsFlashComponent extends FlashComponent
{
    public function error(array $errors, array $options = [])
    {
        $options = array_merge($options, ['escape' => false]);

        $message = '<div class="error">';
        $message .= "<p>".__('The application could not be saved. Please, try again.')."</p>\n";

        $this->recursiveErrorList($errors, $message);

        $message .= "</div>\n";

        parent::error($message, $options);
    }

    private function recursiveErrorList(array $array, &$errorList='') {

        if (count($array)) {
            $errorList .= "\n<ul>\n";
            foreach ($array as $key => $value) {

                if (is_array($value)) {
                    $errorList .= "<li>". h($key)."</li>\n";
                    $this->RecursiveErrorList($value, $errorList);
                }else {
                    $errorList .= "<li>". h($value)."</li>\n";
                }
            }
            $errorList .= "</ul>\n";
        }
    }
}

