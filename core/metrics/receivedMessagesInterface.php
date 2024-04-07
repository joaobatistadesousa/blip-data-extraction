<?php
interface ReceivedMessagesInterface
{
    public function receivedMessages($bot_key, $start_date, $end_date);
}