<ul class="nav nav-tabs">
    {if condition="checkPath('notice/index')"}
    <li><a href="{:Url('notice/index')}">通知列表</a></li>
    {/if}
    {if condition="checkPath('notice/noticeAdd')"}
    <li><a href="{:Url('notice/noticeAdd')}">添加通知</a></li>
    {/if}
    {if condition="checkPath('notice/noticeEdit',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('notice/noticeEdit',['id'=>$info.id])}">修改通知</a></li>
    {/if}
</ul>
 <form  class="form-horizontal" action="{:url('notice/noticeEdit',['id'=>$info.id])}" method="post">
    {include file="form:form_notice" /}
</form>
