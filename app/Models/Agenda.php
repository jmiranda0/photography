<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Agenda
 *
 * @property $id
 * @property $date
 * @property $hour
 * @property $state
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Agenda extends Model
{
    use HasFactory;
    static $rules = [
		'date' => 'required',
		'hour' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['date','hour','state'];



}
