<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{

    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];
    protected $fillable = [
        'title','content','description','image','published_at','category_id','user_id'
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

    //reln between post table and user table

    public function user(){

       return $this->belongsTo(User::class);
    }

    //using query scope for search functioality
    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if(!$search)
        {
            return $query->published();
        }
        
        return $query->published()->where('title','LIKE',"%{$search}%");
    }

    public function scopePublished($query)
    {
        return $query->where('published_at','<=',now());
    }
  
}
