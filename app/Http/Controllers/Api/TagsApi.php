<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagsRequest;
use App\Http\Requests\UpdateTagsRequest;
use App\Models\Tags;

/**
 * 操作tags 的api接口
 */
class TagsApi extends Controller
{
     /**
     * 新增tag
     * @return 返回新增的tag数据
     */
    public function store(StoreTagsRequest $request)
    {
        $tagName = $request -> tagName;
        Tags::create([
            'tag_name' => $tagName,
        ]);
        return $tagName;
    }

    /**
     * 根据id查询tag
     * @return 返回所有tag数据        ID -> ID编号 排序使用      tagName -> tag名字
     */
    public function show($id)
    {
     $tag =    Tags::find($id);
     return $tag ;
        
    }
    /**
     * 查询所有tag
     * @return 返回所有tag数据        ID -> ID编号 排序使用      tagName -> tag名字
     */
    public function showList()
    {
     $tags =    Tags::all();
     return $tags ;
        
    }
}