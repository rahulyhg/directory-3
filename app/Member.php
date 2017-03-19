<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Member extends Model
{
    protected $fillable = [
        'family_id', 'family_role_id', 'first_name', 'last_name', 'email', 'mobile', 'birthday',
        'status_id', 'user_id', 'gender'
    ];


    protected $dates = ['birthday'];


    /*
     * Set 'birthday' attribute value
     */
    public function setBirthdayAttribute($date)
    {
        $this->attributes['birthday'] = Carbon::parse($date);
    }


    /*
     * Get 'birthday' attribute value
     */
    public function getBirthdayAttribute($date)
    {
        return new Carbon($date);
    }


    /*
     * A member belongs to a User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /*
     * A member belongs to a Family
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

}
