<?php
/**
 * Concrete Observers react to the updates issued by the Subject they had been
 * attached to.
 */
class NumberOfBooksLeftNotifier implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        if($subject->state > 1) {
            //There is more than 1 book available, so there is no need for updates
        } else {
            //dinko.omeragic@stu.ibu.edu.ba has been set as a test manager email
            Mail::send_remaining_book_reminder_email($subject->additionalInfo, $subject->state, 'dinko.omeragic@stu.ibu.edu.ba');
        }
    }
}