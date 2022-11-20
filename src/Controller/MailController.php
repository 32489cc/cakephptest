<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\Mailer\Mailer;
/**
 * Mail Controller
 *
 *
 */
class MailController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        if ($this->request->is('post')) {
            $mailer = new Mailer('default');
            $mailer->setFrom(['me@example.com' => 'My site'])
                ->setEmailFormat('text')
                ->setTo('1254902153gxc@gmail.com')
                ->setSubject('テストメール')
                ->viewBuilder()
                ->setTemplate('sample')//這個template是指向email内部的template
                ->setVar('message', 'こんにちは、世界！');
            $mailer->deliver();
    }

        }
}
