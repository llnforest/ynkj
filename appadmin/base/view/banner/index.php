<ul class="nav nav-tabs">
    {if condition="checkPath('banner/index')"}
    <li class="active"><a href="{:Url('banner/index')}">banner列表</a></li>
    {/if}
    {if condition="checkPath('banner/bannerAdd')"}
    <li><a href="{:Url('banner/bannerAdd')}">添加banner</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group layui-form">
                        <select name="updown" class="form-control">
                            <option value="">全部状态</option>
                            <option value="1" {if input('updown') == 1}selected{/if}>上架</option>
                            <option value="0" {if input('updown') === '0'}selected{/if}>下架</option>
                        </select>
                    </div>
                    <div class="btn-group layui-form">
                        <select name="type" class="form-control">
                            <option value="">全部位置</option>
                            <option value="1" {if input('type') == 1}selected{/if}>首页顶部banner</option>
                            <option value="2" {if input('type') == 2}selected{/if}>首页中部banner</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-success">查询</button>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover table-bordered table-list" id="menus-table">
            <thead>
            <tr>
                <th width="80">图片</th>
                <th width="100">标题</th>
                <th width="80">链接</th>
                <th width="80">状态</th>
                <th width="40">排序</th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td><img class="mini-image" src="{$v.url?'__ImagePath__'.$v.url:''}" style="width:80px"></td>
                    <td>{$v.name}</td>
                    <td>{if $v.href}<span class="span-primary" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top"
                                            data-content="{$v.href}">明细</span>{/if}</td>
                    <td class="layui-form">
                        {if condition="checkPath('banner/switchBanner',['id'=>$v.id])"}
                        <input type="checkbox" data-name="updown" data-url="{:url('banner/switchBanner',['id'=>$v.id])}" lay-skin="switch" lay-text="上架|下架" {$v.updown == 1 ?'checked':''} data-value="1|0">
                        {else}
                        {$v.updown == 1?'<span class="blue">上架</span>':'<span class="red">下架</span>'}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('banner/inputBanner',['id'=>$v['id']])"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('banner/inputBanner')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('banner/bannerEdit',['id'=>$v['id']])"}
                        <a  href="{:url('banner/bannerEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('banner/bannerDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('banner/bannerDelete',['id'=>$v['id']])}">删除</a>
                        {/if}
                    </td>
                </tr>
            {/foreach}
            </tbody>
        </table>
    </div>
    <div class="text-center">
        {$page}
    </div>