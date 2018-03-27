<ul class="nav nav-tabs">
    {if condition="checkPath('label/index')"}
    <li class="active"><a href="{:Url('label/index')}">标签列表</a></li>
    {/if}
    {if condition="checkPath('label/labelAdd')"}
    <li><a href="{:Url('label/labelAdd')}">添加标签</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group">
                        <input name="name" value="{:input('name')}" placeholder="标签名称" class="form-control"  type="text">
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
                <th width="80">名称</th>
                <th width="80">排序<span order="sort" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td><img class="mini-image" src="{$v.url?'__ImagePath__'.$v.url:''}" style="width:80px"></td>
                    <td>{$v.name}</td>
                    <td>
                        {if condition="checkPath('label/inputLabel')"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('label/inputLabel')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('label/labelEdit',['id'=>$v['id']])"}
                        <a  href="{:url('label/labelEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('label/labelDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('label/labelDelete',['id'=>$v['id']])}">删除</a>
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