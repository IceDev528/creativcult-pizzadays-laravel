<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class zipCode extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'zipcodes';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'location_id'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id');
    }
    public function users()
    {
        return $this->hasMany('App\User', 'plz');
    }

}
