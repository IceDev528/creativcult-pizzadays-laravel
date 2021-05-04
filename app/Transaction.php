<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'transaction_id', 'method'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
