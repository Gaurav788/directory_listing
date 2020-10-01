<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
				'parent_id',
       			'name',
	    		'description',
				'status',
				'sort_order',
	    		'created_at',
	    		'updated_at',
    ];
    public function parent()
    {
        return $this->belongsTo('Category', 'parent');
    }

    public function children()
    {
        return $this->hasMany('Category', 'parent');
    }
}
