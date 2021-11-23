<?php

 namespace App\Utils\AbstractClasses;

use App\Utils\AbstractClasses\CategoryTreeAbstract;
use Doctrine\Common\Collections\Expr\Value;

class CategoryTreeAdminOptionList extends CategoryTreeAbstract
{

    public function getCategoryList(array $categories_array, int $repeat = 0)
    {
        foreach ($categories_array as $Value) 
        {

            $this->categorylist[] = ['name'=>str_repeat("-",$repeat).$Value['name'], 'id'=>$Value['id']];
      if(!empty($Value['childrean']))
           {
               $repeat = $repeat + 2;
               $this->getCategoryList($Value['children'],$repeat);
               $repeat =$repeat - 2;
           } 
        }
        return $this->categorylist;
    }

}


?>
