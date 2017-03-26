<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\SlugTrait;
use App\Member;
use Carbon\Carbon;


class Family extends Model
{
    use SlugTrait;

    protected $fillable = [
        'name', 'slug', 'status_id', 'address', 'city', 'state', 'zip', 'photo', 'phone', 'anniversary'
    ];

    protected $dates = ['anniversary'];


    /*
     * Set 'anniversary' attribute value
     */
    public function setAnniversaryAttribute($date)
    {
        $this->attributes['anniversary'] = Carbon::parse($date);
    }


    /*
     * Get 'anniversary' attribute value
     */
    public function getAnniversaryAttribute($date)
    {
        return new Carbon($date);
    }


    /*
     * A family has many members
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }


    /*
     * A family has a head member
     */
    public function head()
    {
        return $this->hasOne(Member::class)->where('family_role_id', '=', 1);
    }


    /*
     * A family can have a spouse 
     */
    public function spouse()
    {
        return $this->hasOne(Member::class)->where('family_role_id', '=', 2);
    }


    /*
     * A family can have many dependants
     */
    public function dependants()
    {
        return $this->hasMany(Member::class)->where('family_role_id', '=', 3);
    }
}
