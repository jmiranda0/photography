<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property $id
 * @property $img
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property PostsSocial[] $postsSocials
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Post extends Model
{
    use HasFactory;
    static $rules = [
		'img' => 'required',
		'description' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['img','description'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function postsSocials()
    {
        return $this->hasMany('App\Models\PostsSocial', 'posts_id', 'id');
    }
    

}
