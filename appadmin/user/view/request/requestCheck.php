<ul class="nav nav-tabs">
    {if condition="checkPath('request/index')"}
    <li><a href="{:Url('request/index')}">需求列表</a></li>
    {/if}
    {if condition="checkPath('request/requestCheck',['id' => $info.id])"}
    <li class="active"><a href="{:Url('request/requestCheck',['id' => $info.id])}">需求审核</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('request/requestCheck',['id' => $info.id])}" method="post">
    {include file="form:form_request" /}
</form>
