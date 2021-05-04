<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppSetting extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'appsettings';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['tax','currency','disabled_dates','closed_weekdays','mon_start','mon_end','tue_start','tue_end','wed_start','wed_end','thu_start','thu_end','fri_start','fri_end','sat_start','sat_end','sun_start','sun_end'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function setDisabledDatesAttribute($value)
    {
        $this->attributes['disabled_dates'] = str_replace(",","','",str_replace(" ","",$value));
    }
    public function setClosedWeekdaysAttribute($value)
    {
        $this->attributes['closed_weekdays'] = implode(',',$value);
    }
    

}
