
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>筛选类型</th>
                <td class="layui-form">
                    <input type="radio" name="type" value="1" {if !isset($info.type) ||$info.type == 1}checked{/if} title="区域">
                    <input type="radio" name="type" value="2" {$info.type == 2?'checked':''} title="价格">
                    <input type="radio" name="type" value="3" {$info.type == 3?'checked':''} title="房型">
                </td>
            </tr>
            <tr>
                <th>筛选条件</th>
                <td>
                    <input class="form-control text" type="text" name="term" value="{$info.term??''}" placeholder="筛选条件">
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

