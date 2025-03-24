<?php

namespace App\Http\Controllers;

use App\Models\DB\DBContacts;

class OutlookController extends Controller
{
    public function getContacts($email)
    {
        $contact = DBContacts::where(['email' => $email])->first();
        if ($contact != null)
            return [
                'email' => $contact['email'],
                'fullName' => $contact['fullName'],
                'department' => $contact['department'],
                'phoneNumber' => $contact['phoneNumber'],
                'jobTitle' => $contact['jobTitle']
            ];
        return [];
    }

}
