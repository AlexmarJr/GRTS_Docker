<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'id_company','cep', 'public_place', 'neighborhood','adjunct','number_house','city','state','status',
    ];
}
