<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'is_parent', 'parent_id', 'description'];

    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function parent()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

    public function product()
    {
        return $this->hasMany('App\Product', 'category_id');
    }
}
