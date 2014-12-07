<?php

class Expense extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'expense';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'amount',
        'merchant_id',
        'category_id',
        'notes',
        'attachment',
        'created_at'
    );

    /**
     * The attributes that are sortable.
     *
     * @var array
     */
    static $sortable = array(
        'amount',
        'merchant',
        'category',
        'created_at'
    );
}