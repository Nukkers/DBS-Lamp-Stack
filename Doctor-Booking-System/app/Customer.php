<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Table name
    protected $table = 'customers';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;

    // Create a relationship between a user, this is a Customer's post belongs to a user 
    public function user(){
        return  $this->belongsTo('App\User');
    }

}
