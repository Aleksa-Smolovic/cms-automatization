<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Traits\FileHandling;

class Stats extends Model
{
    
    use SoftDeletes, FileHandling;

    protected $table = "stats";
    
    public $primaryKey = "id";
    protected $guarded = [];
    
            public function getDatePublishedAttribute($value){
                return Carbon::parse($value)->format("d/m/Y");
            }
            
            public function setDatePublishedAttribute($value)
            {
                $this->attributes["date_published"] = Carbon::createFromFormat("d/m/Y", $value);
            }
}
