<?php

namespace app\model;
use app\lib\Database;

class ContactModel 
{

    public static function getContactList($contactId = 0)
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

        $attributes = array();
        if($contactId > 0 && $contactId !== null) {
            $attributes[] = $contactId;
        }

        return $db->prepare($query, $attributes);

    }

    public static function getContact($id)
    {
        $db = new Database();
        $query = 'SELECT * FROM contact WHERE id = ?';
        $result = $db->prepare($query, array($id));
        return $result[0];
    }

    public static function setContact($attributes)
    {

        $db = new Database();

        if($attributes['id'] > 0) {
            $query = '
        UPDATE';
        } else {
            $query = '
        INSERT INTO';
        }

        $query .= '
        contact
        SET
        email = :email,
        name = :name,
        date = :date,
        subject = :subject,
        message = :message,
        message_read = :message_read,
        privacy_consent_date = :privacy_consent_date';

        if($attributes['id'] > 0) {
            $query .= '
        WHERE id = :id';
        } else {
            unset($attributes['id']);
        }

        return $db->prepare($query, $attributes, true);

    }

}
