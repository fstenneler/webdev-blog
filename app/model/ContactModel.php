<?php

namespace app\model;
use app\lib\Database;

class ContactModel 
{

    public static function getContactList($contactId = 0, $messageRead = null)
    {

        $db = new Database();

        $query = '
        SELECT 

        *

        FROM

        contact
        WHERE id > 0';

        if($contactId > 0 && $contactId !== null) {
            $query .= '
        AND id = ?';
        }

        if($messageRead !== null) {
            $query .= '
        AND message_read = ?';
        }

        $attributes = array();
        if($contactId > 0 && $contactId !== null) {
            $attributes[] = $contactId;
        }
        if($messageRead !== null) {
            $attributes[] = $messageRead;
        }

        return $db->prepare($query, $attributes);

    }


}
