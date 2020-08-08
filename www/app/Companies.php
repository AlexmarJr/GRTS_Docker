<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $fillable = [
        'id_user','name_company', 'cnpj', 'phone','name_person','email',
    ];
}
