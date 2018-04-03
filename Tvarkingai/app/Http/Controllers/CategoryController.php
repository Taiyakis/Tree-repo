<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends BaseController
{
    function newCategory(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required',
            'parent' => 'required',
        ]);

        $category = $request->input('category_name');
        $categoryGroup = $request->input('parent');

        $newCategory = new Category;
        $newCategory->cat_name = $category;
        if($categoryGroup != "New category")
        {
            $getParentID = Category::where('cat_name', $categoryGroup)->first();
            $newCategory->parent_id = $getParentID->id;
        }
        else
        {
            $newCategory->parent_id = 0;
        }
        $newCategory->save();

        return redirect ('/');
    }

    function returnRecursiveArray($array)
    {
        $recursive_display = $this->createAssociativeArray($array);
        $recursive_display = $this->getCategoryTreeRecursive($recursive_display);

        return $recursive_display;
    }

    function returnIterativeArray($array)
    {
        $iterative_display = $this->createAssociativeArray($array);
        $iterative_display = $this->getCategoryTreeIterative($iterative_display);

        return $iterative_display;
    }

    function createAssociativeArray($array)
    {
        $new_array = array();
        foreach($array as $row)
        {
            $new_array[$row['id']] = ['id' => $row->id,'cat_name' => $row->cat_name,'parent_id' => $row->parent_id, 'children' => array()];
        }
        return $new_array;
    }

    function getCategoryTreeIterative($array)
    {
        $tree = array();
        foreach($array as $item)
        {
            if(!isset($tree[$item['id']])) 
            {
                $tree[$item['id']] = array();
                $tree[$item['id']] = array_merge($tree[$item['id']],$item);
            }
            if(!isset($tree[$item['parent_id']]))
            {
                $tree[$item['parent_id']] = array();
            }
            if(!isset($tree[$item['parent_id']]['children'])) 
            {
                $tree[$item['parent_id']]['children'] = array();
            }
            if($item['parent_id'] != $item['id'])
            {
                $tree[$item['parent_id']]['children'][] = &$tree[$item['id']];
            }
        }
        $tree = $tree[0]['children'];

        return $tree;
    }

    function getCategoryTreeRecursive(array &$elements, $parentId = 0)
    {
        $tree = array();
    
        foreach ($elements as &$element)
        {
            if ($element['parent_id'] == $parentId)
            {
                $children = $this->getCategoryTreeRecursive($elements, $element['id']);
                if ($children)
                {
                    $element['children'] = $children;
                }
                $tree[$element['id']] = $element;

                unset($element);
            }
        }

        return $tree;
    }

    function getCategory()
    {
        $data = Category::orderby('parent_id', 'ASC')->get();
        
        if(count($data) == 0)
        {
            $iterative_tree = $data;
            $recursive_tree = $data;
        }
        else
        {
            $iterative_timer_start = microtime(true);
            $iterative_tree = $this->returnIterativeArray($data);
            $iterative_timer = round(microtime(true) - $iterative_timer_start, 6);
            
            $recursive_timer_start = microtime(true);
            $recursive_tree = $this->returnRecursiveArray($data);
            $recursive_timer = round(microtime(true) - $recursive_timer_start, 6); 
        }

        return view('home', compact('data', 'iterative_tree', 'recursive_tree', 'iterative_timer',  'recursive_timer'));
    }
}
