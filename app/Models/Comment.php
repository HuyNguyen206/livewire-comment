<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Comment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected static $unguarded = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public function registerMediaConversions(Media $media = null): void
//    {
//        $this->addMediaConversion('encode-jpg')->save
//    }
}
