<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function groups()
    {
        return $this->belongsToMany(Tag::class, 'groupstags',  'tagId','groupId');
    }
    public function maintagingroup (){
        return $this->hasone(groups::class,'Maintag','id');

    }
    public function children (){
        return $this->hasMany(Tag::class,'parentId','id');

    }
    public function posts (){
        return $this->hasMany(Post::class,'tagId','id');

    }
    public function videos (){
        return $this->hasMany(Videos::class,'tagId','id');

    }

    
}
