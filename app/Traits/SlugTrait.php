<?php

namespace App\Traits;

trait SlugTrait
{

    /*
     * Takes an object and checks if the slug attribute is unique, if not, it increments the latest slug by 1
     */
    public static function slugObj($item)
    {

        $item->slug = str_slug($item->slug);

        $latestSlug =
            static::where("id", "!=", $item->id)->whereRaw("slug RLIKE '^{$item->slug}(-[0-9]*)?$'")
                ->latest('id')
                ->value('slug');

        if ($latestSlug) {
            $pieces = explode('-', $latestSlug);

            $number = intval(end($pieces));

            $item->slug .= '-' . ($number + 1);
        }

        return $item->slug;
    }


    /*
     * Checks to see if the slug attribute of an object is unique, if not, it increments the latest slug by 1.
     * Additionally, pass an id to exclude that record from incrementing the slug when editing the entry.
     */
    public static function checkSlug($item, $id = '')
    {

        $item = str_slug($item);

        $latestSlug = static::where("id", "!=", $id)->whereRaw("slug RLIKE '^{$item}(-[0-9]*)?$'")->latest('id')->value('slug');

        if ($latestSlug) {
            $pieces = explode('-', $latestSlug);

            $number = intval(end($pieces));

            $item .= '-' . ($number + 1);
        }

        return $item;
    }

}
