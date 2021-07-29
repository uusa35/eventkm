<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends PrimaryModel
{
    use ModelHelpers, SoftDeletes;
    protected $guarded = [''];
    protected $localeStrings = ['caption', 'title'];
    protected $casts = [
        'is_video' => 'boolean'
    ];

    public function slidable()
    {
        return $this->morphTo();
    }

    public function getTypeAttribute()
    {
        return strtolower(class_basename($this->slidable_type));
    }
}
