<?php 

class Utils{
    public static function getDataFromRequest(){
        return json_decode(file_get_contents('php://input'));
    }

    public static function showCategoryList($categories){
        echo  '<ul>';

        foreach($categories as $category){
            echo  '<li>';
            echo  "{$category['nom']} <a href='/boutique-en-ligne/admin/edit-category.php?id={$category['id']}'>Edytuj</a> <a href='/boutique-en-ligne/admin/categories.php?delete_id={$category['id']}'>Usun</a>";
            if(!empty($category['children'])){
                self::showCategoryList($category['children']);
            }
            echo  '</li>';
        }

        echo  '</ul>';
    }
}