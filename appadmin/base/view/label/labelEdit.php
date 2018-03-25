<ul class="nav nav-tabs">
    {if condition="checkPath('label/index')"}
    <li><a href="{:Url('label/index')}">标签列表</a></li>
    {/if}
    {if condition="checkPath('label/labelAdd')"}
    <li><a href="{:Url('label/labelAdd')}">添加标签</a></li>
    {/if}
    {if condition="checkPath('label/labelEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('label/labelEdit',['id'=>$info.id])}">修改标签</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('label/labelEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_label" /}
</form>
