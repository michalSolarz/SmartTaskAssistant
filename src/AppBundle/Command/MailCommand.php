<?php
/**
 * Created by PhpStorm.
 * User: agata
 * Date: 22/03/15
 * Time: 12:49
 */
namespace AppBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class MailCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('taskassistant:mail')
            ->setDescription('Send mail');
    }



    protected function execute(InputInterface $input, OutputInterface $output)
    {


      //  $r = $this->getContainer()->get('doctrine')->getRepository('');
     //   $r->find...

        $email ="fhtfhtf";

        $content = "xD";
        $subject = "Reminder";


        $mailer = $this->getContainer()->get('mailer');
        $message = $mailer->createMessage()
            ->setSubject($subject)
            ->setFrom('send@example.com')
            ->setTo($email)
            ->setBody($content);


        $mailer->send($message);

        $output->writeln('Sent!');

    }
}