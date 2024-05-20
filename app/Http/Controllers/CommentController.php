<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Extends\Helpers\Result;
use App\Extends\BaseController;

class CommentController extends Controller
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
     * 新增Comment
     * @param userId 作者
     * @param content 内容
     * @param issueId 问题id
     */
    public function store(StoreCommentRequest $request)
    {
        $userId = $request->userId;
        $content = $request->content;
        $issueId = $request->issueId;
        $tags = $request->tags;
        if(empty($userId)){
            return Result::error(' userId is null');
        }
        if(empty($content)){
            return Result::error('content is null');
        }
        if(empty($issueId)){
            return Result::error('issueId is null');
        }








    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
