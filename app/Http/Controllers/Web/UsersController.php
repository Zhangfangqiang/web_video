<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Handlers\FileUploadHandler;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UserRequest;

class UsersController extends Controller
{
    /**
     * 用户个人信息页
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view(env('VIEWLAYER').'.users.show',compact('user'));
    }

    /**
     * 编辑用户个人资料页
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('user', $user);                          #授权策略
        return view(env('VIEWLAYER').'.users.edit', compact('user'));
    }

    /**
     * 更新用户数据的方法
     * @param UserRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('user', $user);                                                           #授权策略
        $data   = $request->only('name', 'email', 'introduction');                                  #获取文本数据

        if($request->avatar){                                                                             #如果选择文件上传
            $config = [
                "pathFormat" => '/avatar/image/{yyyy}{mm}{dd}/{time}{rand:6}',
                "maxSize"    => 2048000,
                "allowFiles" => [".png", ".jpg", ".jpeg", ".gif", ".bmp"]
            ];

            $base64         = "upload";
            $uploader       = new FileUploadHandler($request, 'avatar', $config, $base64);
            $data['avatar'] = $uploader->getFileInfo()['url'];
        }

        $user->update($data);
        return redirect()->route('web.users.show', $user->id)->with('success', '个人资料更新成功！');
    }

    /**
     * 查看我的粉丝和我关注的用户
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relationUser(Request $request, User $user)
    {
        $request->validate([
            'type' => ['required', 'string', 'in:FOLLOW,BEFOLLOW'],
        ]);
        $this->authorize('user',$user);
        return view(env('VIEWLAYER').'.users.relation_list', compact('user','request'));
    }

    /**
     * 关注用户的方法
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function attention(Request $request)
    {
        $request->validate([
            'user_id'    => ['nullable','numeric','exists:users,id'],
        ]);
        $this->authorize('attention',User::find($request->user_id));            #验证权限
        $request->user()->attentionUser()->attach($request->user_id);                 #创建关注关系
        $request->user()->increment('follow_count',1);                                #我关注的用户+1
        User::where('id',$request->user_id)->increment('be_follow_count',1);          #它跟随用户(粉丝) +1

        return response(['success' => '关注成功'], 200);
    }

    /**
     * 取消关注用户的方法
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function cancelAttention(Request $request)
    {
        $request->validate([
            'user_id'    => ['nullable','numeric','exists:users,id'],
        ]);
        $this->authorize('cancelAttention',User::find($request->user_id));            #验证权限
        $request->user()->attentionUser()->detach($request->user_id);                       #取消关系
        $request->user()->decrement('follow_count',1);                                      #我关注的用户-1
        User::where('id',$request->user_id)->decrement('be_follow_count',1);                #它跟随用户(粉丝)  -1

        return response(['success' => '取消关注成功'], 200);
    }

    /**
     * 与用户有关系的内容列表
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contentList(Request $request , User $user)
    {
        $request->validate([
            'type' => ['required', 'string', 'in:AWESOME,FAVORITE,RELEASE'],
        ]);

        if (in_array($request->type, ['AWESOME', 'FAVORITE'])) {
            $this->authorize('user', $user);
        }

        return view(env('VIEWLAYER').'.users.content_list', compact('request','user'));
    }

    /**
     * 评论列表用户开始
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function commentList(Request $request, User $user)
    {
        return view(env('VIEWLAYER').'.users.comment_list', compact('request', 'user'));
    }
}
