<?php

namespace Inani\Larapoll;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
   
     use SoftDeletes;
     
    protected $fillable = [
        'user_id', 'option_id'
    ];
    protected $table = 'larapoll_votes';

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
