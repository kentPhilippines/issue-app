<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagsRequest;
use App\Http\Requests\UpdateTagsRequest;
use App\Models\Tags;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

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
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tags $tags)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagsRequest $request, Tags $tags)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tags $tags)
    {
        //
    }
}
