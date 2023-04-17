<?php

namespace App\Models\ListItems;

use App\Models\Traits\ImageTransformTrait;
use App\Models\Hashtags\Hashtag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ListItem extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia, ImageTransformTrait;

    protected $fillable = [
        'name',
        'text',
        'is_done',
        'author_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
        'updated_at' => 'datetime:d.m.Y',
    ];

    /**
     * @return morphToMany
     */
    public function hashtags(): MorphToMany
    {
        return $this->morphToMany(Hashtag::class, 'hashtaggable');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
