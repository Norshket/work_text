<?php

namespace App\Models\ListItems;

use App\Models\Hashtags\Hashtag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListItem extends Model
{
    use HasFactory, SoftDeletes;

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
