<?php

use Illuminate\Database\Eloquent\Builder;
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
    public static $sortable = array(
        'amount',
        'merchant',
        'category',
        'created_at'
    );

    /**
     * Category
     *
     * @return Builder
     */
    public function category()
    {
        return $this->belongsTo('Category');
    }

    /**
     * Merchant
     *
     * @return Builder
     */
    public function merchant()
    {
        return $this->belongsTo('Merchant');
    }
}