<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //

    /**

     * The database table used by the model.
     *
     * @var string

     */

    protected $table = 'hotels';

    protected $fillable = [

        'name', 'available', 'floor', 'room_no', 'per_room_price'

    ];
}
