<ul class="nav nav-tabs">
    {if condition="checkPath('search/index')"}
    <li class="active"><a href="{:Url('search/index')}">筛选列表</a></li>
    {/if}
    {if condition="checkPath('search/searchAdd')"}
    <li><a href="{:Url('search/searchAdd')}">添加筛选</a></li>
    {/if}
</ul>
 <div>
        <div class="cf well form-search row">

            <form  method="get">
                <div class="fl">
                    <div class="btn-group layui-form">
                        <select name="type" class="form-control">
                            <option value="">筛选类型</option>
                            <option value="1" {if input('type') == 1}selected{/if}>区域</option>
                            <option value="2" {if input('type') == 2}selected{/if}>价格</option>
                            <option value="3" {if input('type') == 3}selected{/if}>房型</option>
                        </select>
                    </div>
                    <div class="btn-group">
                        <input name="term" value="{:input('term')}" placeholder="筛选条件" class="form-control"  type="text">
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
                <th width="80">筛选类型<span order="type" class="order-sort"> </span></th>
                <th width="80">筛选条件</th>
                <th width="80">排序<span order="sort" class="order-sort"> </span></th>
                <th width="80">操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $list as $v}
                <tr>
                    <td>{$v.type|str_replace=[1,2,3],['区域','价格','房型'],###}</td>
                    <td>{$v.term}</td>
                    <td>
                        {if condition="checkPath('search/inputSearch',['id'=>$v['id']])"}
                        <input class="form-control change-data short-input"  post-id="{$v.id}" post-url="{:url('search/inputSearch')}" data-name="sort" value="{$v.sort}">
                        {else}
                        {$v.sort}
                        {/if}
                    </td>
                    <td>
                        {if condition="checkPath('search/searchEdit',['id'=>$v['id']])"}
                        <a  href="{:url('search/searchEdit',['id'=>$v['id']])}">编辑</a>
                        {/if}
                        {if condition="checkPath('search/searchDelete',['id'=>$v['id']])"}
                            <a  class="span-post" post-msg="确定要删除吗" post-url="{:url('search/searchDelete',['id'=>$v['id']])}">删除</a>
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