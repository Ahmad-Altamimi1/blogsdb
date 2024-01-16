<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;

    // function slider()
    // {
    //     return $this->hasmany(slider::class, 'postId', "id");
    // }
    function user()
    {
        return $this->belongsTo(User::class, 'WRITER', "id");
    }
    function tag()
    {
        return $this->belongsTo(Tag::class, 'tagId', "id");
    }
    public function group(){
        return $this->belongsTo(groups::class,"groupId");
            }
}
