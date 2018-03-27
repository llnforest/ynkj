<ul class="nav nav-tabs">
    {if condition="checkPath('reserve/index')"}
    <li class="active"><a href="{:Url('reserve/index')}">预约列表</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group layui-form">
                        <select name="status" class="form-control">
                            <option value="">全部状态</option>
                            <option value="0" {if input('status') === '0'}selected{/if}>待审核</option>
                            <option value="1" {if input('status') == 1}selected{/if}>预约成功</option>
                            <option value="2" {if input('status') == 2}selected{/if}>取消预约</option>
                        </select>
                    </div>
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
                        <input name="start" value="{:input('start')}" placeholder="预约起始日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="end" value="{:input('end')}" placeholder="预约结束日期" readonly dom-class="date-end" class="date-time date-end form-control laydate-icon"  type="text">
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
                <th width="100">状态</th>
                <th width="80">预约日期<span order="reserve_date" class="order-sort"> </span></th>
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
                    <td>{if $v.status == 1}<span class="blue">预约成功</span>{elseif $v.status == 2}<span class="red">取消预约</span>{else}待审核{/if}</td>
                    <td>{$v.reserve_date}</td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('reserve/checkSuccess',['id'=>$v['id']]) && $v.status == 0"}
                        <span class="span-primary check-success" data-id="{$v.id}">预约时间</span>
                        {/if}
                        {if condition="checkPath('reserve/operateReserve',['id'=>$v['id']]) && $v.status == 0"}
                        <span  class="span-post" post-msg="确定要取消预约吗" post-url="{:url('reserve/operateReserve',['id'=>$v['id'],'data'=>2,'name'=>'status'])}">取消预约</span>
                        {/if}
                        {if condition="checkPath('reserve/reserveDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('reserve/reserveDelete',['id'=>$v['id']])}">删除</a>
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
<script>
    $('.check-success').click(function(){
        var id = $(this).attr("data-id");
        openLayer = layer.open({
            type: 2,
            title: '选择预约时间',
            shadeClose: true,
            shade: [0.3, '#393D49'],
            area: ['400px', '450px'],
            content: "{:url('reserve/checkSuccess','','')}/id/"+id,
        })
    })
</script>