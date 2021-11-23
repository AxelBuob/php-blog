<?php

namespace Core\Html;

class Html
{

    public static function escapeSpecialCharacters($query)
    {
        if(is_array($query))
        {
            $array = [];
            foreach($query as $object)
            {
                $new_object = new $object;
                $properties = (array) $object;
                foreach ($properties as $k => $v) {
                    $new_object->$k = strip_tags($v, '<p>');
                }
                $array[] = $new_object;
            }
            return $array;
        }
        else 
        {
            $new_object = new $query;
            $properties = (array) $query;
            foreach ($properties as $k => $v) {
                $new_object->$k = strip_tags($v, '<p>');
            }
            return $new_object;
        }
    }
}