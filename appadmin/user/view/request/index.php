<ul class="nav nav-tabs">
    {if condition="checkPath('request/index')"}
    <li class="active"><a href="{:Url('request/index')}">需求列表</a></li>
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
                            <option value="1" {if input('status') == 1}selected{/if}>审核通过</option>
                            <option value="2" {if input('status') == 2}selected{/if}>审核失败</option>
                            <option value="3" {if input('status') == 3}selected{/if}>已发布</option>
                        </select>
                    </div>
                    <div class="btn-group layui-form">
                        <select name="type" class="form-control">
                            <option value="">需求类型</option>
                            <option value="1" {if input('type') == 1}selected{/if}>买</option>
                            <option value="2" {if input('type') == 2}selected{/if}>卖</option>
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
                    <div class="btn-group">
                        <input name="nick_name" value="{:input('nick_name')}" placeholder="经纪人" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="phone" value="{:input('phone')}" placeholder="手机号" class="form-control"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="start" value="{:input('start')}" placeholder="需求起始日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
                    </div>
                    <div class="btn-group">
                        <input name="end" value="{:input('end')}" placeholder="需求结束日期" readonly dom-class="date-end" class="date-time date-end form-control laydate-icon"  type="text">
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
                <th width="100">需求类型<span order="type" class="order-sort"> </span></th>
                <th width="100">房源标签<span order="label_id" class="order-sort"> </span></th>
                <th width="100">需求备注</th>
                <th width="80">状态<span order="status" class="order-sort"> </span></th>
                <th width="100">经纪人</th>
                <th width="80">需求时间<span order="create_time" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.phone}</td>
                    <td>{if $v.type == 1}<span class="red">买</span>{else}<span class="blue">卖</span>{/if}</td>
                    <td>{$v.label_name}</td>
                    <td>{if $v.remark}<span class="span-primary" data-container="body" data-trigger="hover" data-toggle="popover" data-placement="top"
                                          data-content="{$v.remark}">明细</span>{/if}</td>
                    <td>{if $v.status == 1}<span class="blue">审核通过</span>{elseif $v.status == 2}<span class="red">审核失败</span>{elseif $v.status == 3}<span class="blue">已发布</span>{else}待审核{/if}</td>
                    <td>{$v.nick_name}</td>
                    <td>{$v.create_time}</td>
                    <td>
                        {if condition="checkPath('request/requestCheck',['id'=>$v['id']]) && $v.status == 0"}
                        <a  href="{:url('request/requestCheck',['id'=>$v['id']])}">审核</a>
                        {/if}
                        {if condition="checkPath('request/requestCheck',['id'=>$v['id']]) && $v.status >= 1"}
                        <a  href="{:url('request/requestCheck',['id'=>$v['id']])}">详情</a>
                        {/if}
                        {if condition="checkPath('house/house/houseAdd',['id'=>$v['id']]) && $v.status == 1 && $v.type == 2"}
                        <a  href="{:url('house/house/houseAdd',['id'=>$v.id])}">发布房源</a>
                        {/if}
                        {if condition="checkPath('request/requestDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('request/requestDelete',['id'=>$v['id']])}">删除</a>
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