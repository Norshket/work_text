<?php

namespace App\Models\Hashtags;

use App\Models\ListItems\ListItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hashtag extends Model
{
    use HasFactory;

    protected $table = 'hashtags';

    protected $fillable =[
        'name'
    ];


    public function listItems()
    {
        return $this->morphedByMany(ListItem::class, 'hashtaggable');
    }
}
