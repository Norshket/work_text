<?php

namespace App\Models\ListItems;

use App\Models\Traits\ImageTransformTrait;
use App\Models\Hashtags\Hashtag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ListItem extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia , ImageTransformTrait;

    protected $fillable = [
        'name',
        'text'
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
        'updated_at' => 'datetime:d.m.Y',
    ];

    public function hashtags()
    {
        return $this->morphToMany(Hashtag::class, 'hashtaggable');
    }
}
