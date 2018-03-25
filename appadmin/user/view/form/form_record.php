
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>房源标题</th>
                <td>
                    <input class="form-control text click-show" type="text" data-url="{:url("house/house/houseList")}" value="{$info.title??''}" placeholder="请输入想要查找的房源标题" data-msg="房源标题">
                    <input class="form-control text click-id" type="hidden" name="house_id" value="{$info.title??''}">
                    <ul class="list-group click-show-wrap text">
                    </ul>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>用户手机</th>
                <td>
                    <input class="form-control text click-show" type="text" data-url="{:url("user/user/userList")}" value="{$info.phone??''}" placeholder="请输入想要查找的用户手机" data-msg="用户手机">
                    <input class="form-control text click-id" type="hidden" name="user_id" value="{$info.phone??''}">
                    <ul class="list-group click-show-wrap text">
                    </ul>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>看房日期</th>
                <td>
                    <input name="record_date" value="{$info.record_date??''}"  readonly dom-class="check-date" class="date-time check-date form-control laydate-icon text"  type="text" placeholder="请选择看房日期">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <button type="button" class="btn btn-success form-post " >保存</button>
                    <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
