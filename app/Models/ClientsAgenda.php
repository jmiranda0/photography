<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ClientsAgenda
 *
 * @property $id
 * @property $clients_id
 * @property $agendas_id
 * @property $created_at
 * @property $updated_at
 *
 * @property Agenda $agenda
 * @property Client $client
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class ClientsAgenda extends Model
{
    use HasFactory;
    static $rules = [
		'clients_id' => 'required',
		'agendas_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['clients_id','agendas_id'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function agenda()
    {
        return $this->hasOne('App\Models\Agenda', 'id', 'agendas_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function client()
    {
        return $this->hasOne('App\Models\Client', 'id', 'clients_id');
    }
    

}
