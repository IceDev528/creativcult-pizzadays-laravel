<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attributes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function product()
    {
        return $this->belongsToMany('App\Product')->withPivot('price')->withTimestamps();
    }
}
