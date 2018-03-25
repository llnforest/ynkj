
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>手机号</th>
                <td>
                    <input class="form-control text" type="text" name="phone" value="{$info.phone??''}" placeholder="手机号">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>密码</th>
                <td>
                    <input class="form-control text" type="text" name="password" value="" placeholder="{$info.password?'更改密码':'密码'}">
                    <span class="form-required">{$info.password?'填写更改密码，不填密码不更改':'*'}</span>
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

