<ul class="nav nav-tabs">
    {if condition="checkPath('user/index')"}
    <li class="active"><a href="{:Url('user/index')}">用户列表</a></li>
    {/if}
    {if condition="checkPath('user/userAdd')"}
    <li><a href="{:Url('user/userAdd')}">添加用户</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group">
                        <input name="phone" value="{:input('phone')}" placeholder="手机号" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="start" value="{:input('start')}" placeholder="注册起始日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="end" value="{:input('end')}" placeholder="注册结束日期" readonly dom-class="date-end" class="date-time date-end form-control laydate-icon"  type="text">
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
                <th width="100">手机号</th>
                <th width="80">注册时间<span order="create_time" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.phone}</td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('user/userEdit',['id'=>$v['id']])"}
                        <a  href="{:url('user/userEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('user/userDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('user/userDelete',['id'=>$v['id']])}">删除</a>
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