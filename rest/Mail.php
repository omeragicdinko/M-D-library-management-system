<?php
class Mail
{
    public static function send_remaining_book_reminder_email($book_name, $number_of_books_left, $manager_email)
    {
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.elasticemail.com', 2525))
            ->setUsername('dinko.omeragic@stu.ibu.edu.ba')
            ->setPassword('73643BBE1F9BAD2E3EE2682FF5D9E685F10E');

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        if ($number_of_books_left === 1) {
            // Create a message
            $message = (new Swift_Message('Remaining book remainder'))
                ->setFrom([$manager_email => 'Manager'])
                ->setTo([$manager_email => 'Manager'])
                ->setBody('Dear Manager, <br><br> There is only one book with the name <b>' . $book_name . '</b> left.', 'text/html');
        } elseif ($number_of_books_left === 0) {
            // Create a message
            $message = (new Swift_Message('Remaining book remainder'))
                ->setFrom([$manager_email => 'Manager'])
                ->setTo([$manager_email => 'Manager'])
                ->setBody('Dear Manager, <br><br> There are no books with the name <b>' . $book_name . '</b> left.', 'text/html');
        }

        // Send the message
        $result = $mailer->send($message);
    }
}