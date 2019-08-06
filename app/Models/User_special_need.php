<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_special_need extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_special_needs';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['special_need_date', 'comment', 'security_user_id', 'special_need_type_id', 'special_need_difficulty_id', 'modified_user_id', 'modified', 'created_user_id', 'created'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['special_need_date', 'modified', 'created'];

}