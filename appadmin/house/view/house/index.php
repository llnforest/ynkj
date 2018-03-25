<ul class="nav nav-tabs">
    {if condition="checkPath('house/index')"}
    <li class="active"><a href="{:Url('house/index')}">房源列表</a></li>
    {/if}
    {if condition="checkPath('house/houseAdd')"}
    <li><a href="{:Url('house/houseAdd')}">添加房源</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group layui-form">
                        <select name="status" class="form-control">
                            <option value="">全部状态</option>
                            <option value="1" {if input('status') == 1}selected{/if}>已上架</option>
                            <option value="2" {if input('status') == 2}selected{/if}>等待审核</option>
                            <option value="3" {if input('status') == 3}selected{/if}>审核失败</option>
                            <option value="4" {if input('status') == 4}selected{/if}>已成交</option>
                            <option value="0" {if input('status') === '0'}selected{/if}>已下架</option>
                        </select>
                    </div>
                    <div class="btn-group layui-form">
                        <select name="label_id" class="form-control">
                            <option value="">房源标签</option>
                            {foreach $labelList as $item}
                            <option value="{$item.id}" {if input('label_id') == $item.id}selected{/if}>{$item.name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="btn-group layui-form">
                        <select name="fangxing" class="form-control">
                            <option value="">全部房型</option>
                            {foreach $fangList as $item}
                            <option value="{$item.id}" {if input('fangxing') == $item.id}selected{/if}>{$item.term}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="btn-group layui-form">
                        <select name="quyu" class="form-control">
                            <option value="">全部区域</option>
                            {foreach $quList as $item}
                            <option value="{$item.id}" {if input('quyu') == $item.id}selected{/if}>{$item.term}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="btn-group">
                        <input name="title" value="{:input('title')}" placeholder="房源标题" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="nick_name" value="{:input('nick_name')}" placeholder="经纪人" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="start" value="{:input('start')}" placeholder="创建起始日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="end" value="{:input('end')}" placeholder="创建结束日期" readonly dom-class="date-end" class="date-time date-end form-control laydate-icon"  type="text">
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
                <th width="100">房源标题</th>
                <th width="100">房源标签<span order="label_id" class="order-sort"></span></th>
                <th width="100">房型<span order="fangxing" class="order-sort"></span></th>
                <th width="100">区域<span order="quyu" class="order-sort"></span></th>
                <th width="100">状态</th>
                <th width="100">经纪人<span order="admin_id" class="order-sort"></span></th>
                <th width="80">创建时间<span order="create_time" class="order-sort"></span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.title}</td>
                    <td>{$v.label_name}</td>
                    <td>{$v.fangxing_name}</td>
                    <td>{$v.quyu_name}</td>
                    <td>{if $v.status == 1}<span class="blue">预约成功</span>{elseif $v.status == 2}<span class="red">取消预约</span>{else}待审核{/if}</td>
                    <td>{$v.nick_name}</td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('house/houseEdit',['id'=>$v['id']]) && $v.status == 0"}
                        <a  href="{:url('house/houseEdit',['id'=>$v['id']])}">修改</a>
                        {/if}
                        {if condition="checkPath('house/houseDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('house/houseDelete',['id'=>$v['id']])}">删除</a>
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
            content: "{:url('house/checkSuccess','','')}/id/"+id,
        })
    })
</script>