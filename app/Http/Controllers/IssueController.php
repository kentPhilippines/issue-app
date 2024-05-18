<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;

class IssueController extends Controller
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
     * 发布issue
     */
    public function store(StoreIssueRequest $request)
    {
            return  $request->all();
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $issue =  Issue::find($id);
        return $issue;
    }
    /**
     * 根据条件查询所有发布的问题标题
     */
    public function showList(Issue $issue)
    {
       $issues =  Issue::orderBy('created_at','desc')->get();
       return $issues;
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Issue $issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIssueRequest $request, Issue $issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Issue $issue)
    {
        //
    }
}
