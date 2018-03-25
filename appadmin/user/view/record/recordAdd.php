<ul class="nav nav-tabs">
    {if condition="checkPath('record/index')"}
    <li><a href="{:Url('record/index')}">看房列表</a></li>
    {/if}
    {if condition="checkPath('record/recordAdd')"}
    <li class="active"><a href="{:Url('record/recordAdd')}">添加看房</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('record/recordAdd')}" method="post">
    {include file="form:form_record" /}
</form>
