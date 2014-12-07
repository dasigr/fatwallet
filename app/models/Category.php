<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vocabulary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $fillable = array(
        'name',
        'parent'
    );
}