<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\IssuesInvites;
use App\Models\IssuesTags;
use App\Models\Tags;
use App\Models\User;

class IssueController extends Controller
{
    /**
     * 精华推荐跳转页面并携带帖子数量
     */
    public function index()
    {
       return view("content.recommend") -> with('issues', Issue::orderBy('created_at', 'desc')->get());
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
        /**
         * 新增问题
         */
        $user =  $request->user();
        $issue = Issue::create([
            'title' => $request->title,
            'content' => $request->content,
            'announcer' =>  $user->id,
            'status' =>  1
        ]);
        $issueId = $issue->id;
        /**
         * 新增邀请人记录
         */

        $tags = $request->tags; //#宠物#铲死官      标签
        $invites = $request->invites; //@张三@李四  邀请人
        if (!empty($invites)) {
            $mark  = '@';
            /**
             * 新增邀请人和issue 的一对多记录表
             * 
             * ## 这里首先要验证邀请人是否存在，如果存在则可以加入邮件提醒或者系统内部的其他提醒【这里不做这样的操作】
             */
            $inviteArray = explode($mark, $invites);
            foreach ($inviteArray as $invite) {
                // 排除空的元素（可能是字符串开头和结尾的空部分）
                $usered = User::firstWhere('name', $invite);
                if (!empty($invite) && !empty($usered)) {
                    IssuesInvites::create([
                        'user' => $usered->id,
                        'issue' => $issueId
                    ]);
                }
            }
        }
        /**
         * 新增问题tags
         */
        if (!empty($tags)) {
            $mark  = '#';
            /**
             * 查询数据库如果存在这个标签直接获取标签id，如果不存在这个标签在获取这个标签的id后新增 标签和 issue 的一对多记录表
             */
            $tagsArray = explode($mark, $tags);
            foreach ($tagsArray as $tag) {
                // 排除空的元素（可能是字符串开头和结尾的空部分）
                if (!empty($tag)) {
                    $dbTag = Tags::firstWhere('tag_name', $tag);
                    if (!empty($dbTag)) { //如果不为空则直接新增 issue 的一对多关系 ， 如果为空 则首先新增
                        IssuesTags::create([
                            'tag'=> $dbTag->id,
                            'issue'=>$issueId
                        ]);
                    } else {
                        $dbTag = Tags::create([
                            'tag_name' => $tag,
                        ]);
                        IssuesTags::create([
                            'tag'=> $dbTag->id,
                            'issue'=>$issueId
                        ]);
                    };
                }
            }
        }
        return view("content.recommend") -> with('issues', Issue::orderBy('created_at', 'desc')->get());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $issue =  Issue::find($id);
        return $issue;
    }
    public function myShow(StoreIssueRequest $request)
    {
        $user =  $request->user();
        $issues =  Issue::where('announcer',$user->id)->get();;
        return view("content.dashboard") -> with('issues',$issues);
    }
    /**
     * 根据条件查询所有发布的问题标题
     */
    public function showList(Issue $issue)
    {
        $issues =  Issue::orderBy('created_at', 'desc')->get();
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
