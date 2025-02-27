<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdempiereConnection extends Model
{
    use HasFactory;

    protected $table = 'idempiere_conection';
    public $timestamps = false;
    
    protected $fillable = [
        'token', 'url', 'ftu_app_client_id', 'ftu_app_org_id', 
        'ftu_app_role_id', 'ftu_app_warehouse_id', 'ad_languajes', 
        'user', 'password'
    ];
}
