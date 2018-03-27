<ul class="nav nav-tabs">
    {if condition="checkPath('record/index')"}
    <li class="active"><a href="{:Url('record/index')}">看房列表</a></li>
    {/if}
    {if condition="checkPath('user/userAdd')"}
    <li><a href="{:Url('record/recordAdd')}">添加看房</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group">
                        <input name="nick_name" value="{:input('nick_name')}" placeholder="经纪人" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="phone" value="{:input('phone')}" placeholder="手机号" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="title" value="{:input('title')}" placeholder="房源名称" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="start" value="{:input('start')}" placeholder="看房起始日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="end" value="{:input('end')}" placeholder="看房结束日期" readonly dom-class="date-end" class="date-time date-end form-control laydate-icon"  type="text">
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
                <th width="100">用户</th>
                <th width="100">房源名称</th>
                <th width="100">经纪人</th>
                <th width="80">看房日期<span order="record_date" class="order-sort"> </span></th>
                <th width="80">创建时间<span order="create_time" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.phone}</td>
                    <td>{$v.title}</td>
                    <td>{$v.nick_name}</td>
                    <td>{$v.record_date}</td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('record/recordDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('record/recordDelete',['id'=>$v['id']])}">删除</a>
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