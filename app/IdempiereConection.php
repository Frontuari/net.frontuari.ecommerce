<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdempiereConection extends Model
{
    use HasFactory;

    protected $table = 'idempiere_conection';
    protected $fillable = ['url','token', 'user', 'password', 'client_id', 'role_id', 'org_id', 'warehouse_id','ad_languajes'];
}
