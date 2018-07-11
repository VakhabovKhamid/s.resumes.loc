<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 04.07.18
 * Time: 16:42
 */

namespace App\Controller\Component;


use Cake\Controller\Component;
use Cake\Mailer\Email;

class NotifyComponent extends Component
{
    public function email(array $from, string $to, string $subject, string $body, array $options=[])
    {
        $email = new Email('default');
        $email->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->send($body);
    }
}