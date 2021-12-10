<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class ContactNotification {


    /**
     * @var Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer){

        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }
    public function notify(Contact $contact){
        $message = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('hodicq.william@gmail.com')
            ->replyTo($contact->getEmail())
            ->htmlTemplate('emails/contact.html.twig')
            //->textTemplate('emails/contact.txt.twig')
            ->context(['contact'=>$contact]);

        $this->mailer->send($message);

    }
}