<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Sentinel;
class Location extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'locations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function zipcodes()
    {
        return $this->hasMany('App\zipCode', 'location_id');
    }

    public function user()
    {
        return $this->hasMany('App\User', 'location_id');
    }

     public function manager(){
         $role = Sentinel::findRoleBySlug('manager');
         $manager = $role->users()->where('location_id',$this->id)->first();
         if ($manager) {
           return  $manager;
         }
        return false;
    }

}
