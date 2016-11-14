<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model {

    protected $fillable = [
        'title',
        'body',
        'published_at',
        'user_id'
    ];
    
    protected $dates = ['published_at'];
    
    public function scopePublished($query){ //Article::published($value-2nd argument)
        $query->where('published_at', '<=', Carbon::now());
    }
    
    public function scopeUnpublished($query){
        $query->where('published_at', '>=', Carbon::now());
    }
    
    // setNameAttribute()
    public function setPublishedAtAttribute($date){
        $this->attributes['published_at'] = Carbon::parse($date);
    }
    
    //get the published_at attribute
    public function getPublishedAtAttribute($date) {
        return Carbon::parse($date)->format('Y-m-d');
    }
    
    //An article is owned by a user
    public function user(){
        return $this->belongsTo('App\User'); //user_id
        
    }
    
    //Get the tags associated with the given article
    public function tags(){
        
        return $this->belongsToMany('App\Tag')->withTimestamps();
        
    }
    
    //get a list of tag id' associated with this article
    public function getTagListAttribute(){
        return $this->tags->lists('id');
    }

}
