<?php

namespace Controller;

use Helper\Controller\BaseController as BaseController;

class MailController
{

    public function sendMail($body, $to = 'press.start.dummy@gmail.com')
    {
        $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('press.start.dummy@gmail.com')
            ->setPassword('lemdp123');

        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message('Nouveau compte créé sur Press Start :)'))
            ->setFrom(['press.start.dummy@gmail.com' => 'Press Start'])
            ->setTo([$to => 'user'])
            ->setBody($body,'text/html');

        $mailer->send($message);
    }
}
