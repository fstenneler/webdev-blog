<?php

namespace app\model;
use app\lib\Database;

class CategoryModel 
{

    public static function getCategoryList($categoryId = 0)
    {

        $query = '
        SELECT 

        *

        FROM category';

        if( $categoryId > 0 ) {
            $query .= '
        WHERE id = ?';
        }

        $query .= '
        ORDER BY name ASC';

        $attributes = array();
        if($categoryId > 0) {
            $attributes[] = $categoryId;
        }        

        return Database::prepare($query, $attributes);

    }

    public static function getCategoryName($categoryId = 0)
    {

        $query = '
        SELECT 

        name

        FROM category

        WHERE id = ?';

        $result = Database::prepare($query, array($categoryId));

        if(isset($result[0]->name)) {
            return $result[0]->name;
        }
        return null;

    }

    public static function categoryExists($categoryId = 0)
    {

        $query = '
        SELECT 

        COUNT(id) AS value

        FROM category

        WHERE id = ?';

        $result = Database::prepare($query, array($categoryId));

        if($result[0]->value > 0) {
            return $result[0]->value;
        }
        return false;

    }

    public static function getCategoryByName($categoryName)
    {

        $query = '
        SELECT 

        id

        FROM category

        WHERE id = ?';

        $result = Database::prepare($query, array($categoryName));

        if($result[0]->value > 0) {
            return $result[0]->value;
        }
        return 0;

    }

}
