<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
class Voucher extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vouchers';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'description', 'uses','location_id','zip_code_id','user_id', 'max_uses', 'max_uses_user', 'discount_amount', 'is_fixed', 'starts_at', 'expires_at','voucher_type'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function setStartsAtAttribute($value)
    {
         $selectedDate=Carbon::createFromFormat('d/m/Y H:i',$value);
        $this->attributes['starts_at'] = $selectedDate->format('Y-m-d H:i');
    }
    public function setExpiresAtAttribute($value)
    {
        if ($value) {
          $selectedDate=Carbon::createFromFormat('d/m/Y H:i',$value);
         $this->attributes['expires_at'] = $selectedDate->format('Y-m-d H:i');
        }
         
    }
    public function getStartsAtAttribute($value)
    {
        if ($value) {
          $selectedDate=Carbon::createFromFormat(' Y-m-d H:i:s',$value);
         return $selectedDate->format('d/m/Y H:i');
        }
        
    }
    public function getExpiresAtAttribute($value)
    {
         $selectedDate=Carbon::createFromFormat(' Y-m-d H:i:s',$value);
        return $selectedDate->format('d/m/Y H:i');
    }

    public function location()
    {
        return $this->belongsTo('App\Location', 'location_id');
    }
    public function zipcode()
    {
        return $this->belongsTo('App\zipCode', 'zip_code_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function carts()
    {
        return $this->belongsToMany('App\Cart')->withTimestamps();
    }
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

}
