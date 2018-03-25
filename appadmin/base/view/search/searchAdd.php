<ul class="nav nav-tabs">
    {if condition="checkPath('search/index')"}
    <li><a href="{:Url('search/index')}">筛选列表</a></li>
    {/if}
    {if condition="checkPath('search/searchAdd')"}
    <li class="active"><a href="{:Url('search/searchAdd')}">添加筛选</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('search/searchAdd')}" method="post">
    {include file="form:form_search" /}
</form>
