<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{

    use SoftDeletes;
    protected $fillable = [
        'title','content','description','image','published_at','category_id'
    ];

    public function deleteImage()
    {
        Storage::delete($this->image);
    }

    public function category(){
       return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    /**
     * checks if post has tags
     * @return bool
     */
    public function hasTag($tagId){
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }
  
}
