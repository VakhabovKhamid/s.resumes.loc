<?php
/**
 * Created by PhpStorm.
 * User: ramil
 * Date: 27.07.18
 * Time: 9:49
 */

namespace App\Event;


use App\Model\Resource\ShortMessage;
use Cake\Datasource\ModelAwareTrait;
use Cake\Event\EventListenerInterface;

class UserAuthenticateEvent implements EventListenerInterface
{
    use ModelAwareTrait;

    private $ShortMessages;

    public function __construct()
    {
        $this->modelFactory('Endpoint', ['Muffin\Webservice\Model\EndpointRegistry', 'get']);
        $this->ShortMessages = $this->loadModel('ShortMessages', 'Endpoint');
    }

    /**
     * Returns a list of events this object is implementing. When the class is registered
     * in an event manager, each individual method will be associated with the respective event.
     *
     * ### Example:
     *
     * ```
     *  public function implementedEvents()
     *  {
     *      return [
     *          'Order.complete' => 'sendEmail',
     *          'Article.afterBuy' => 'decrementInventory',
     *          'User.onRegister' => ['callable' => 'logRegistration', 'priority' => 20, 'passParams' => true]
     *      ];
     *  }
     * ```
     *
     * @return array associative array or event key names pointing to the function
     * that should be called in the object when the respective event is fired
     */
    public function implementedEvents()
    {
        return [
            'User.sendVerifyCode' => 'sendVerifyCode',
            'User.retrySendVerifyCode' => 'sendVerifyCode'
        ];
    }

    public function sendVerifyCode($event, $phone, $token)
    {
        $this->sendSms($phone, $token);
    }

    private function sendSms($phone, $text)
    {
        $sms = new ShortMessage();
        $sms->phone = $phone;
        $sms->text = 'Kod: '. $text;

        $this->ShortMessages->save($sms);
    }
}