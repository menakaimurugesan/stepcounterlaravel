<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{	
    //
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','date','steps'];
	
	/**
     * Get the user that owns the activity.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
