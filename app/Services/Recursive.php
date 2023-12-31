<?php

namespace App\Services;

class Recursive
{
    private $categoryHtml = '';
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function printCategories ($parent_id, $id, $prefix = '') {
        foreach ($this->data as $value) {
            if($value['parent_id'] === $id) {
                if (!empty($parent_id) && $value['id'] === $parent_id) {
                    $this->categoryHtml .= '<option value=' . $value['id'] . ' selected >' . $prefix . $value['name'] . '</option>';
                } else {
                    $this->categoryHtml .= '<option value=' . $value['id'] . '>' . $prefix . $value['name'] . '</option>';
                }
                $this->printCategories($parent_id, $value['id'], $prefix . '-');
            }
        }

        return $this->categoryHtml;
    }

    public function getCategory ($categories) {
        $this->data = $this->data::all();
        if (is_object($categories)) {
            $this->categoryHtml = $this->printCategories($categories['parent_id'] ? $categories['parent_id'] : $categories['category_id'], 0, '');
        } else {
            $this->categoryHtml = $this->printCategories(null, 0, '');
        }


        return $this->categoryHtml;
    }
}
