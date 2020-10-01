<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cms_page extends Model
{
    public $timestamps = false;
    protected $fillable = [
       	'title',
       	'slug',
       	'short_description',
       	'description',
		'meta_title',
       	'meta_keyword',
       	'meta_content',
		'status',
	    'created_at',
	    'updated_at',
    ];
}
