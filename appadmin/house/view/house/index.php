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
                            <option value="2" {if input('status') == 2}selected{/if}>审核中</option>
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
                        <input name="title" value="{:input('title')}" placeholder="房源名称" class="form-control"  type="text">
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
                <th width="100">房源名称</th>
                <th width="60">房源标签<span order="label_id" class="order-sort"></span></th>
                <th width="60">房型<span order="fangxing" class="order-sort"></span></th>
                <th width="60">区域<span order="quyu" class="order-sort"></span></th>
                <th width="50">状态</th>
                <th width="60">经纪人<span order="admin_id" class="order-sort"></span></th>
                <th width="40">排序<span order="sort" class="order-sort"> </span></th>
                <th width="40">推荐</th>
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
                    <td>{if $v.status == 1}<span class="blue">已上架</span>{elseif $v.status == 2}<span class="red">审核中</span>{elseif $v.status == 3}<span class="grey">审核失败</span>{elseif $v.status == 4}<span class="green">已成交</span>{else}<span class="yellow">已下架</span>{/if}</td>
                    <td>{$v.nick_name}</td>
                    <td>
                        {if condition="checkPath('house/inputHouse')"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('house/inputHouse')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td class="layui-form">
                        {if condition="checkPath('house/switchHouse',['id'=>$v.id]) && $v.status == 1"}
                        <input type="checkbox" data-name="is_commend" data-url="{:url('house/switchHouse',['id'=>$v.id])}" lay-skin="switch" lay-text="推荐|取消" {$v.is_commend == 1 ?'checked':''} data-value="1|0">
                        {/if}
                    </td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('house/houseEdit',['id'=>$v['id']]) && in_array($v.status,[0,3])"}
                        <a  href="{:url('house/houseEdit',['id'=>$v['id']])}">修改</a>
                        {/if}
                        {if condition="checkPath('house/operateHouse',['id'=>$v['id'],'data'=>2]) && in_array($v.status,[0,3])"}
                        <span  class="span-post" post-msg="确认提交申请吗？审核通过后将会上架" post-url="{:url('house/operateHouse',['id'=>$v['id'],'data'=>2,'name'=>'status'])}">上架申请</span>
                        {/if}
                        {if condition="checkPath('house/operateHouse',['id'=>$v['id'],'data'=>1]) && in_array($v.status,[2])"}
                        <span  class="span-post" post-msg="确认房源上架吗？" post-url="{:url('house/operateHouse',['id'=>$v['id'],'data'=>1,'name'=>'status'])}">确认上架</span>
                        {/if}
                        {if condition="checkPath('house/operateHouse',['id'=>$v['id'],'data'=>3]) && in_array($v.status,[2])"}
                        <span  class="span-post" post-msg="确认打回重审吗？" post-url="{:url('house/operateHouse',['id'=>$v['id'],'data'=>3,'name'=>'status'])}">打回重审</span>
                        {/if}
                        {if condition="checkPath('house/operateHouse',['id'=>$v['id'],'data'=>4]) && in_array($v.status,[1])"}
                        <span  class="span-post" post-msg="确认打回重审吗？" post-url="{:url('house/operateHouse',['id'=>$v['id'],'data'=>4,'name'=>'status'])}">确认成交</span>
                        {/if}
                        {if condition="checkPath('house/houseDetail') && in_array($v.status,[1,2,4])"}
                        <a  href="{:url('house/houseDetail',['id'=>$v['id']])}">查看</a>
                        {/if}
                        {if condition="checkPath('house/houseDelete',['id'=>$v['id']]) && in_array($v.status,[0,3])"}
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