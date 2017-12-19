<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = 'voucher';
    protected $fillable = ['name', 'code', 'discount','max_claim','claimed', 'status','start_date', 'end_date'];

}
