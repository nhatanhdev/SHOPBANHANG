<?php
namespace App\Components;
class Recusive {
    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function categoryRecusive($parent_id,$id = 0, $char = ''){
        foreach($this->data as $value){

            if($value['parent_id'] == $id){
                if(!empty($parent_id) && $value['id'] == $parent_id){
                    $this->htmlSelect .= "<option  selected value='" . $value['id'] . "'>" . $char . $value['name'] . "</option>";

                }
                else {
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>" . $char . $value['name'] . "</option>";

                }
                $this->categoryRecusive($parent_id,$value['id'], $char.'⎯');
            }
        }
        return $this->htmlSelect;
    }
}
