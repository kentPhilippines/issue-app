<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Extends\Helpers\Result;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Exceptions\ServerExceptionHandler;
use Throwable;

use function Laravel\Prompts\error;
use App\Models\IssuesComments;
use PHPUnit\Framework\TestStatus\Success;
use App\Models\IssuesTags;
use App\Models\Tags;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use App\Models\Issue;
use App\Models\IssuesInvites;
use App\Models\User;

class IssueApi extends Controller
{

    /**
     * 发布issue
     */
    public function store(StoreIssueRequest $request)
    {
        /**
         * 新增问题
        */
        $userId =  $request->userId;
        $issue = Issue::create([
            'title' => $request->title,
            'content' => $request->content,
            'announcer' =>  $userId,
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
                            'tag' => $dbTag->id,
                            'issue' => $issueId
                        ]);
                    } else {
                        $dbTag = Tags::create([
                            'tag_name' => $tag,
                        ]);
                        IssuesTags::create([
                            'tag' => $dbTag->id,
                            'issue' => $issueId
                        ]);
                    };
                }
            }
        }
        return view("content.recommend")->with('issues', Issue::orderBy('created_at', 'desc')->get());

    }

    /**
     * 修改问题状态的方法
     * 这里应该对比当前 登陆user 的 token 和传递的token 是否一致
     * @param userId 操作人
     * @param stauts 操作状态
     * @param issueId 问题id
     */
    public function update(UpdateIssueRequest $request)
    {
        $issue_status = $request->stauts; #操作状态
        $userId = $request->userId; #操作人
        $issueId = $request->issueId;
        $issue_status_array =  [
            "open" => 1,
            "close" => 2,
            "reopen" => 3
        ];
        /**
         * 状态不可以open  只允许 close 和 reopen
         */
        if (isset(json_encode($issue_status_array)[$issue_status]) || 1 == $issue_status_array[$issue_status]) {
            return Result::error('issue status is error');
        };
        /**
         * 操作状态的修改只允许 处理人和发起人修改
         */
        $issue =  Issue::find($issueId);
        if (empty($issue)) {
            return Result::error('issue  is null');
        }
        /**
         * 验证处理人    只有发布者和 邀请评论者可以修改状态
         */
        $operationPermission = false;
        $comments =   Comment::join('issues_comments', 'comments.id', '=', 'issues_comments.issue')
            ->where('issues_comments.issue', '=', $issueId)
            ->select('comments.*')->get();
        foreach ($comments as $comment) {
            if ($comment->announcer ==  $userId) {
                $operationPermission = true;
            }
        }
        $issue =   Issue::find($issueId);
        if ($issue->announcer ==  $userId) {
            $operationPermission = true;
        }
        if ($operationPermission) {
            $issue->status = $issue_status_array[$issue_status];
            $issue->save();
            return Result::success('operation is successful ', $issue);
        } else {
            return Result::error('operation is error ! this is Permission broblem');
        }
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
     * 查询issue 的详细情况,包括评论，邀请人，标签等
     * @param id  issue 的id
     */
    public function show($id)
    {
        $issue =  Issue::find($id);
        $users =  IssuesInvites::where('issue', $issue->id)->get();
        $tags = Tags::join('issues_tags', 'tags.id', '=', 'issues_tags.tag')
            ->where('issues_tags.issue', '=', $issue->id)
            ->select('tags.*')
            ->get();
        $comments =   Comment::join('issues_comments', 'comments.id', '=', 'issues_comments.id')
            ->where('issues_comments.issue', '=', $issue->id)
            ->select('comments.*')->get();
        $array = [
            'issue' => $issue,
            'tags' => $tags,
            'invites' => $users,
            'comments' => $comments
        ];
        return  Result::success('success', $array);
    }
}
