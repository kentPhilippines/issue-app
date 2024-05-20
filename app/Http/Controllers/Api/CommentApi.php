<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Extends\Helpers\Result;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Exceptions\ServerExceptionHandler;
use Throwable;

use App\Models\IssuesComments;
use App\Models\IssuesTags;
use App\Models\Tags;

use function Laravel\Prompts\error;

class CommentApi extends Controller
{
    /**
     * 新增Comment
     * @param userId 作者
     * @param content 内容
     * @param issueId 问题id
     */
    public function store(StoreCommentRequest $request)
    {
        $userId = $request->userId;
        $title = $request->title;
        $content = $request->content;
        $issueId = $request->issueId;
        $tags = $request->tags;
        /**
         * 判断为空的方法应该可以添加一个注释用注释处理
         */
        if (empty($userId)) {
            return Result::error(' userId is null');
        }
        if (empty($title)) {
            return Result::error(' title is null');
        }
        if (empty($content)) {
            return Result::error('content is null');
        }
        if (empty($issueId)) {
            return Result::error('issueId is null');
        }
        try {
            $comment =  Comment::create(
                [
                    'title' => $title,
                    'content' => $content,
                    'announcer' => $userId
                ]
            );
            $id =  $comment->id;
            if (!empty($id)) {
                IssuesComments::create([
                    'id' => $id,
                    'issue' => $issueId
                ]);
            }
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
        } catch (Throwable $e) {
            throw new ServerExceptionHandler("add comment is error", 500);
        }
        return Result::success(' is successful');
    }

    /**
     * 根据回答id 查看具体的回答信息
     * @param $id 问答id
     */
    public function show($id)
    {
        if (!empty($id)) {
            return Result::success('query is successful', Comment::find($id));
        }
        return error(" query id is null");
    }

    /**
     * 根据问题id 查询所有的回复
     * @param issueId 问题id
     */
    public function showList($issueId)
    {
        if (!empty($issueId)) {
            return Result::success('query is successful', 
            Comment::join('issues_comments', 'comments.id', '=', 'issues_comments.issue')
                ->where('issues_comments.issue', '=', $issueId)
                ->select('comments.*')->get());
        }
        return error(" query id is null");
    }
}
