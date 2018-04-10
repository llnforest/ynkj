<ul class="nav nav-tabs">
    {if condition="checkPath('better/index')"}
    <li><a href="{:Url('better/index')}">卖点列表</a></li>
    {/if}
    {if condition="checkPath('better/betterAdd')"}
    <li><a href="{:Url('better/betterAdd')}">添加卖点</a></li>
    {/if}
    {if condition="checkPath('better/betterEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('better/betterEdit',['id'=>$info.id])}">修改卖点</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('better/betterEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_better" /}
</form>
