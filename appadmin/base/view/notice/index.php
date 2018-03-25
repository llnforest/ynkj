<ul class="nav nav-tabs">
    {if condition="checkPath('notice/index')"}
    <li class="active"><a href="{:Url('notice/index')}">通知列表</a></li>
    {/if}
    {if condition="checkPath('notice/noticeAdd')"}
    <li><a href="{:Url('notice/noticeAdd')}">添加通知</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group">
                        <input name="title" value="{:input('title')}" placeholder="通知标题" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="start" value="{:input('start')}" placeholder="发布起始日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="end" value="{:input('end')}" placeholder="发布结束日期" readonly dom-class="date-end" class="date-time date-end form-control laydate-icon"  type="text">
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
                <th width="100">标题</th>
                <th width="50">内容</th>
                <th width="40">排序<span order="sort" class="order-sort"> </span></th>
                <th width="80">发布时间<span order="update_time" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.title}</td>
                    <td>{if $v.content}<span class="span-primary" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top"
                                            data-content="{$v.content}">明细</span>{/if}</td>
                    <td>
                        {if condition="checkPath('notice/inputNotice',['id'=>$v['id']])"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('notice/inputNotice')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>{$v.update_time}</td>
                    <td>
                        {if condition="checkPath('notice/noticeEdit',['id'=>$v['id']])"}
                        <a  href="{:url('notice/noticeEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('notice/noticeDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('notice/noticeDelete',['id'=>$v['id']])}">删除</a>
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