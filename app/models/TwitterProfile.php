<?php

class TwitterProfile extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'twitter_profile_stats';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    public static function findOrCreate($id)
    {
        $obj = static::find($id);
        return $obj ?: new static;
    }

}
