
<div class="col-sm-12">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>房源名称</th>
                <td>
                    <input class="form-control text" type="text" name="title" value="{$info.title??''}" placeholder="房源名称">
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>经纪人</th>
                <td>
                    <input class="form-control text click-show" type="text" data-url="{:url("index/admin/adminList")}" value="{$info.nick_name??$Think.session.admin_user.nick_name}" placeholder="请输入想要查找的经纪人" data-msg="经纪人">
                    <input class="form-control text click-id" type="hidden" name="admin_id" value="{$info.nick_name?$info.admin_id:$Think.session.admin_user.id}">
                    <ul class="list-group click-show-wrap text">
                    </ul>
                    <span class="form-required">*</span>
                </td>
            </tr>
            {if !empty($info.guapai_date)}
            <tr>
                <th>挂牌日期</th>
                <td>
                    <input name="guapai_date" value="{$info.guapai_date??''}"  readonly dom-class="gua-date" class="date-time gua-date form-control laydate-icon text"  type="text" placeholder="请选择挂牌日期">
                </td>
            </tr>
            {/if}
            <tr>
                <th>房源标签</th>
                <td>
                    <select name="label_id" class="form-control text">
                        {foreach $labelList as $item}
                        <option value="{$item.id}" {$info.label_id == $item.id?'selected':''}>{$item.name}</option>
                        {/foreach}
                    </select>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>选择房型</th>
                <td>
                    <select name="fangxing" class="form-control text">
                        {foreach $fangList as $item}
                        <option value="{$item.id}" {$info.fangxing == $item.id?'selected':''}>{$item.term}</option>
                        {/foreach}
                    </select>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>选择区域</th>
                <td>
                    <select name="quyu" class="form-control text">
                        {foreach $quList as $item}
                        <option value="{$item.id}" {$info.quyu == $item.id?'selected':''}>{$item.term}</option>
                        {/foreach}
                    </select>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>房源售价</th>
                <td>
                    <input class="form-control text" type="text" name="price" value="{$info.price??''}" placeholder="房源售价（万元）">
                    <span class="input-text">万元</span>
                    <span class="form-required">*</span>
                </td>
            </tr>
            <tr>
                <th>房源面积</th>
                <td>
                    <input class="form-control text" type="text" name="mianji" value="{$info.mianji??''}" placeholder="房源面积（平方米）">
                    <span class="input-text">平方米</span>
                </td>
            </tr>
            <tr>
                <th>房源朝向</th>
                <td>
                    <input class="form-control text" type="text" name="chaoxiang" value="{$info.chaoxiang??''}" placeholder="房源朝向">
                </td>
            </tr>
            <tr>
                <th>所在楼层</th>
                <td>
                    <input class="form-control text" type="text" name="louceng" value="{$info.louceng??''}" placeholder="所在楼层（层）">
                    <span class="input-text">层</span>
                </td>
            </tr>
            <tr>
                <th>房源楼型</th>
                <td>
                    <input class="form-control text" type="text" name="louxing" value="{$info.louxing??''}" placeholder="房源楼型">
                </td>
            </tr>
            <tr>
                <th>有无电梯</th>
                <td class="layui-form">
                    <input type="checkbox" data-name="dianti" lay-skin="switch" lay-text="有|无" {if !isset($info.dianti) || $info.dianti == 1}checked{/if} data-value="1|0">
                </td>
            </tr>
            <tr>
                <th>装修情况</th>
                <td>
                    <input class="form-control text" type="text" name="zhuangxiu" value="{$info.zhuangxiu??''}" placeholder="装修情况">
                </td>
            </tr>
            <tr>
                <th>建造年代</th>
                <td>
                    <input name="niandai" value="{$info.niandai??''}"  readonly dom-class="check-date" dom-format="yyyy" class="date-time check-date form-control laydate-icon text"  type="text" placeholder="请选择建造年代">
                </td>
            </tr>
            <tr>
                <th>房源用途</th>
                <td>
                    <input class="form-control text" type="text" name="yongtu" value="{$info.yongtu??''}" placeholder="房源用途">
                </td>
            </tr>
            <tr>
                <th>房源权属</th>
                <td>
                    <input class="form-control text" type="text" name="quanshu" value="{$info.quanshu??''}" placeholder="房源权属">
                </td>
            </tr>
            <tr>
                <th>首付预算</th>
                <td>
                    <input class="form-control text" type="text" name="shoufu" value="{$info.shoufu??''}" placeholder="首付预算">
                    <span class="input-text">万元</span>
                </td>
            </tr>
            <tr>
                <th>小区名称</th>
                <td>
                    <input class="form-control text" type="text" name="xiaoqu" value="{$info.xiaoqu??''}" placeholder="小区名称">
                </td>
            </tr>
            <tr>
                <th>房源介绍</th>
                <td>
                    <textarea name="description" class="form-control text" placeholder="房源介绍">{$info.description??''}</textarea>
                </td>
            </tr>

            <tr>
                <th>税费解析</th>
                <td>
                    <textarea name="shuifeijiexi" class="form-control text" placeholder="税费解析">{$info.shuifeijiexi??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>装修描述</th>
                <td>
                    <textarea name="zhuangxiumiaoshu" class="form-control text" placeholder="装修描述">{$info.zhuangxiumiaoshu??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>户型介绍</th>
                <td>
                    <textarea name="huxingjieshao" class="form-control text" placeholder="户型介绍">{$info.huxingjieshao??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>核心卖点</th>
                <td>
                    <textarea name="hexinmaidian" class="form-control text" placeholder="核心卖点">{$info.hexinmaidian??''}</textarea>
                </td>
            </tr>
            <tr>
                <th>房源图片</th>
                <td>
                    <div class="img-wrap">
                        {if isset($imgList)}
                        {foreach $imgList as $item}
                        <div class="img-block">
                            <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'house'])}'}">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                                <input class="image" type="hidden" name="url" value="{$item.url??''}">
                                <img class="mini-image" data-path="__ImagePath__" src="__ImagePath__{$item.url}">
                            </button>
                            <input type="text" class="form-control img-sort" placeholder="排序" value="{$item.sort??''}">
                            <button class="layui-btn layui-btn-primary layui-btn-sm img-delete">
                                <i class="layui-icon">&#xe640;</i>
                            </button>
                        </div>
                        {/foreach}
                        {else}
                        <div class="img-block">
                            <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'house'])}'}">
                                <i class="layui-icon">&#xe67c;</i>上传图片
                                <input class="image" type="hidden" name="url" value="">
                                <img class="mini-image hidden" data-path="__ImagePath__" src="">
                            </button>
                            <input type="text" class="form-control img-sort" placeholder="排序">
                            <button class="layui-btn layui-btn-primary layui-btn-sm img-delete">
                                <i class="layui-icon">&#xe640;</i>
                            </button>
                        </div>
                        {/if}
                    </div>
                    <div class="img-block clone">
                        <button name="image" type="button" class="layui-btn upload" lay-data="{'url': '{:url('index/upload/image',['type'=>'house'])}'}">
                            <i class="layui-icon">&#xe67c;</i>上传图片
                            <input class="image" type="hidden" name="url" value="">
                            <img class="mini-image hidden" data-path="__ImagePath__" src="">
                        </button>
                        <input type="text" class="form-control img-sort" placeholder="排序">
                        <button class="layui-btn layui-btn-primary layui-btn-sm img-delete">
                            <i class="layui-icon">&#xe640;</i>
                        </button>
                    </div>
                    <div class="add-img-btn">
                        <i class="layui-icon">&#xe654;</i>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input id="img_data" type="hidden" name="img_data" value="">
                    <input type="hidden" name="request_id" value="{$info.request_id??''}">
                    <button type="button" class="btn btn-success form-post " >保存</button>
                    <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
    $(function(){
        $(".add-img-btn").click(function(){
            var _clone = $(".clone").clone(true,true).removeClass("clone");
            $(".img-wrap").append(_clone);
            return false;
        })

        $(".img-delete").click(function(){
            $(this).parents('.img-block').remove();
        })

        $(".form-post").click(function(){
            var sublist = [];
            $(".img-wrap .img-block").each(function(index,item){
                var url = $(item).find(".image").val();
                if(url == '') return;
                var sort = $(item).find(".img-sort").val().trim();
                sublist.push({'url':url,sort:sort});
            })
            $("#img_data").val(JSON.stringify(sublist));
        })
    })
</script>
