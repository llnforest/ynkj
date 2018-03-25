<ul class="nav nav-tabs">
    {if condition="checkPath('user/index')"}
    <li><a href="{:Url('user/index')}">用户列表</a></li>
    {/if}
    {if condition="checkPath('user/userAdd')"}
    <li class="active"><a href="{:Url('user/userAdd')}">添加用户</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('user/userAdd')}" method="post">
    {include file="form:form_user" /}
</form>
