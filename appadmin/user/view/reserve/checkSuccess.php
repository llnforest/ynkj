{__NOLAYOUT__}
{include file="publics:topCss"}
<div class="container-fluid  text-center"  style="padding-top:12px;">
    <div id="alert"></div>
    <form class="form-horizontal" action="{:url('reserve/checkSuccess',['id'=>$info.id])}">
        <input name="reserve_date" value="" placeholder="选择预约日期" readonly dom-class="date-start" class="date-time date-start form-control laydate-icon"  type="text">
        <div class="layer-box-bottom" style="padding-top:0;">
            <button type="button" class="btn btn-success form-post" >确认预约</button>
            <span class="btn btn-default active layui-off">关闭</span>
        </div>
    </form>
</div>
{include file="publics:bottomJs"}