
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>需求用户</th>
                <td>
                    {$info.phone}
                </td>
            </tr>
            <tr>
                <th>需求时间</th>
                <td>
                    {$info.create_time}
                </td>
            </tr>
            <tr>
                <th>房源标签</th>
                <td>
                    {$info.label_name}
                </td>
            </tr>
            <tr>
                <th>需求类型</th>
                <td>
                    {if $info.type == 1}<span class="red">买</span>{else}<span class="blue">卖</span>{/if}
                </td>
            </tr>
            <tr>
                <th>需求备注</th>
                <td>
                    {$info.remark}
                </td>
            </tr>
            <tr>
                <th>需求图片</th>
                <td>
                    {foreach $imgList as $item}
                    <img class="table-image" src="__ImagePath__{$item.url}">
                    {/foreach}
                </td>
            </tr>
            <tr>
                <th>经纪人</th>
                <td>
                    {if $info.status == 0}
                    <input class="form-control text click-show" type="text" data-url="{:url("index/admin/adminList")}" value="{$Think.session.admin_user.nick_name}" placeholder="请输入想要查找的经纪人" data-msg="经纪人">
                    <input class="form-control text click-id" type="hidden" name="admin_id" value="{$Think.session.admin_user.id}">
                    <ul class="list-group click-show-wrap text">
                    </ul>
                    <span class="form-required">*</span>
                    {else}
                    {$info.nick_name}
                    {/if}
                </td>
            </tr>
            <tr>
                <th>审核状态</th>
                <td class="layui-form">
                    {if $info.status == 0}
                    <input type="checkbox" data-name="status" lay-skin="switch" lay-text="通过|失败" checked data-value="1|2">
                    {else}
                    {if $info.status == 1}<span class="blue">审核通过</span>{elseif $info.status == 2}<span class="red">审核失败</span>{elseif $info.status == 3}<span class="blue">已发布</span>{else}待审核{/if}
                    {/if}
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    {if $info.status == 0}
                    <button type="button" class="btn btn-success form-post " >审核</button>
                    {elseif checkPath('house/house/houseAdd',['id'=>$info['id']]) && $info.status == 1 && $info.type == 2}
                    <a class="btn btn-success" href="{:url('house/house/houseAdd',['id'=>$info.id])}">发布房源</a>
                    {/if}
                    <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
