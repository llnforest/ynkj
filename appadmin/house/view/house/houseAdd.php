<ul class="nav nav-tabs">
    {if condition="checkPath('house/index')"}
    <li><a href="{:Url('house/index')}">房源列表</a></li>
    {/if}
    {if condition="checkPath('house/houseAdd')"}
    <li class="active"><a href="{:Url('house/houseAdd')}">添加房源</a></li>
    {/if}
    
</ul>
 <form  class="form-horizontal" action="{:url('house/houseAdd')}" method="post">
    {include file="form:form_house" /}
</form>
