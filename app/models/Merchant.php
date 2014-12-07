<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Merchant extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = array(
        'name',
        'category_id'
    );
}