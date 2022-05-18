<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JsonData extends Controller
{
    public function getJsonApi() {
        $json_url = "https://ewp.co.il/product_json.php";
        $json = file_get_contents($json_url);
        $removeTags = strip_tags($json);
        $data = json_decode($removeTags, true);
        return $data;
    }

    function getProductItem() {
        $productItem = [];

        // get json from api url
        $getJsonFile = $this->getJsonApi();
        // product
        $productItems = $getJsonFile['products'];
        // attributes
        $attributes = $getJsonFile['attributes'];
        // get categories name

        for ($i = 0;$i  < count($productItems);$i++){
            $getProduct = $this->getProduct($i,$productItems,$attributes);
            array_push($productItem, $getProduct);
        }

        return  $productItem;
    }

    function getProduct($id,$productItems,$attributes) {
        $productItem = [];
        $attributesArray = [];
        $getCategoryList = $this->getCategoriesByProduct($productItems[$id]['categories']);
        $productItem[$id]["id"] = $productItems[$id]['id'];
        $productItem[$id]["title"] = $productItems[$id]['title'];
        $productItem[$id]["categories"] = $getCategoryList;
        $productItem[$id]["price"] = $productItems[$id]['price'];
        for ($a = 0; $a < count($productItems[$id]['labels']); $a++) {
            $checked = false;
            $addAttribute = $this->getAttributeItemByProduct($attributes,$productItems[$id]['labels'][$a]);
            if($a > 0){
                foreach($attributesArray as $key => $value){
                    if($addAttribute['title'] === $value['title']){
                        $oldValue = is_array($value['description']) ? $value['description'][0] : [$value['description']];
                        $value['description'] = array_merge($oldValue, [$addAttribute['description']]);
                        $attributesArray[$key]['description'] = [$value['description']];
                        $checked = true;
                    }
                }
            }
            if(!$checked)
                $attributesArray[count($attributesArray)] = $addAttribute;
        }
        $productItem[$id]["attribute"] = $attributesArray;
        return $productItem;
    }
    function getCategoriesByProduct($category) {
        $array = [];
        for ($i = 0; $i < count($category); $i++) {
            array_push($array, $category[$i]['title']);
        }
        return $array;
    }
    function getAttributeItemByProduct($attributes, $label) {
        $arrayAttributes = [];
        for ($i = 0; $i < count($attributes); $i++) {
            for ($a = 0; $a < count($attributes[$i]['labels']); $a++) {
                $arrayAttributes['title'] = $attributes[$i]['title'];
                if($attributes[$i]['labels'][$a]['id'] === $label){
                    $attributesDescription = $attributes[$i]['labels'][$a]['title'];
                    $arrayAttributes['description'] = $attributesDescription;
                    return $arrayAttributes;
                }
            }
        }
        return;
    }

}
