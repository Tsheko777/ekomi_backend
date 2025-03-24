<?php

namespace App\Models\DB;

use Illuminate\Database\Eloquent\Model;

class DBContacts extends Model
{
    protected $table = "tbl_contacts";
    protected $guarded = ['id'];
}
