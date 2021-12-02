<?php

class MailProfiler
{
    private $mails;

    public function __construct($mails)
    {
        if (!is_dir(FCPATH . 'application/cache/profiler/email/')) {
            mkdir(FCPATH . 'application/cache/profiler/email/');
        }

        $this->mails = $mails;
    }

    public function getMails()
    {
        return $this->mails;
    }

    public function addMail($to, $subject, $message)
    {
        $mails = $this->getMails();
        $mails['total_mail'] += 1;

        $mails['mails'][] = array(
            'to'      => $to,
            'subject' => utf8_encode($subject),
            'message' => $this->storeMail($message)
        );

        return $mails;
    }

    private function storeMail($message)
    {
        $date      = new DateTime('now',new DateTimeZone('America/Havana'));

        $file_name = 'email-'.$date->format('Ymd-His').'.html';
        file_put_contents(FCPATH . 'application/cache/profiler/email/'.$file_name, $message, LOCK_EX);

        return $file_name;
    }
}