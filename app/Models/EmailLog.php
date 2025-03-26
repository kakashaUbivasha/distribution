<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function campaign(){
        return $this->belongsTo(EmailCampaign::class);
    }
}
