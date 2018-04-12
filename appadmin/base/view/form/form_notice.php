
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>通知标题</th>
                <td>
                    <input class="form-control text" type="text" name="title" value="{$info.title??''}" placeholder="通知标题">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>通知内容</th>
                <td>
                    <textarea name="content" class="form-control text" placeholder="通知内容">{$info.content??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>经纪人</th>
                <td>
                    <input class="form-control text click-show" type="text" data-url="{:url("index/admin/adminList")}" value="{$info.nick_name??$Think.session.admin_user.nick_name}" placeholder="请输入想要查找的经纪人" data-msg="经纪人">
                    <input class="form-control text click-id" type="hidden" name="admin_id" value="{$info.nick_name?$info.admin_id:$Think.session.admin_user.id}">
                    <ul class="list-group click-show-wrap text">
                    </ul>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>通知图片</th>
                <td>
                    <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'notice'])}'}">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                        <input class="image" type="hidden" name="banner_url" value="{$info.banner_url??''}">
                        <img class="mini-image {$info.banner_url?'':'hidden'}" data-path="__ImagePath__" src="{$info.banner_url?'__ImagePath__'.$info.banner_url:''}">
                    </button>
                    <span class="red block">(图片建议大小750*380)</span>
                </td>
            </tr>
            <tr>
                <th>房型图片</th>
                <td>
                    <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'notice'])}'}">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                        <input class="image" type="hidden" name="house_url" value="{$info.house_url??''}">
                        <img class="mini-image {$info.house_url?'':'hidden'}" data-path="__ImagePath__" src="{$info.house_url?'__ImagePath__'.$info.house_url:''}">
                    </button>
                    <span class="red block">(图片建议大小750*380)</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="button" class="btn btn-success form-post " >保存</button>
                    <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

