<ul class="nav nav-tabs">
    {if condition="checkPath('house/index')"}
    <li><a href="{:Url('house/index')}">房源列表</a></li>
    {/if}
    {if condition="checkPath('house/houseAdd')"}
    <li><a href="{:Url('house/houseAdd')}">添加房源</a></li>
    {/if}
    {if condition="checkPath('house/houseEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('house/houseEdit',['id'=>$info.id])}">修改房源</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('house/houseEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_house" /}
</form>
