<ul class="nav nav-tabs">
    {if condition="checkPath('house/index')"}
    <li><a href="{:Url('house/index')}">房源列表</a></li>
    {/if}
    {if condition="checkPath('house/houseAdd')"}
    <li><a href="{:Url('house/houseAdd')}">添加房源</a></li>
    {/if}
    {if condition="checkPath('house/houseDetail',['id'=>$info.id])"}
    <li class="active"><a href="{:Url('house/houseDetail',['id'=>$info.id])}">查看房源</a></li>
    {/if}
</ul>
 <form  class="form-horizontal">

     <div class="col-sm-12">
         <table class="table table-bordered">
             <tbody>
             <tr>
                 <th>房源名称</th>
                 <td>
                     {$info.title??''}
                 </td>
             </tr>
             <tr>
                 <th>经纪人</th>
                 <td>
                     {$info.nick_name??''}
                 </td>
             </tr>
             {if !empty($info.guapai_date)}
             <tr>
                 <th>挂牌日期</th>
                 <td>
                     {$info.guapai_date??''}
                 </td>
             </tr>
             {/if}
             <tr>
                 <th>房源标签</th>
                 <td>
                     {$info.label_name??''}
                 </td>
             </tr>
             <tr>
                 <th>房源卖点</th>
                 <td>
                     {$better.title??''}
                 </td>
             </tr>
             <tr>
                 <th>房型名称</th>
                 <td>
                     {$info.fangxing_name??''}
                 </td>
             </tr>
             <tr>
                 <th>区域名称</th>
                 <td>
                     {$info.quyu_name??''}
                 </td>
             </tr>
             <tr>
                 <th>房源售价</th>
                 <td>
                     {$info.price??''}万元
                 </td>
             </tr>
             <tr>
                 <th>房源面积</th>
                 <td>
                     {$info.mianji??''}平方米
                 </td>
             </tr>
             <tr>
                 <th>房源朝向</th>
                 <td>
                     {$info.chaoxiang??''}
                 </td>
             </tr>
             <tr>
                 <th>所在楼层</th>
                 <td>
                     {$info.louceng??''}层
                 </td>
             </tr>
             <tr>
                 <th>房源楼型</th>
                 <td>
                     {$info.louxing??''}
                 </td>
             </tr>
             <tr>
                 <th>有无电梯</th>
                 <td class="layui-form">
                     {if $info.dianti}有{else}无{/if}
                 </td>
             </tr>
             <tr>
                 <th>装修情况</th>
                 <td>
                     {$info.zhuangxiu??''}
                 </td>
             </tr>
             <tr>
                 <th>建造年代</th>
                 <td>
                     {$info.niandai??''}
                 </td>
             </tr>
             <tr>
                 <th>房源用途</th>
                 <td>
                     {$info.yongtu??''}
                 </td>
             </tr>
             <tr>
                 <th>房源权属</th>
                 <td>
                     {$info.quanshu??''}
                 </td>
             </tr>
             <tr>
                 <th>首付预算</th>
                 <td>
                     {$info.shoufu??''}万元
                 </td>
             </tr>
             <tr>
                 <th>小区名称</th>
                 <td>
                     {$info.xiaoqu??''}
                 </td>
             </tr>
             <tr>
                 <th>房源介绍</th>
                 <td>
                     {$info.description??''}
                 </td>
             </tr>

             <tr>
                 <th>税费解析</th>
                 <td>
                    {$info.shuifeijiexi??''}
                 </td>
             </tr>
             <tr>
                 <th>装修描述</th>
                 <td>
                     {$info.zhuangxiumiaoshu??''}
                 </td>
             </tr>
             <tr>
                 <th>户型介绍</th>
                 <td>
                     {$info.huxingjieshao??''}
                 </td>
             </tr>
             <tr>
                 <th>核心卖点</th>
                 <td>
                     {$info.hexinmaidian??''}
                 </td>
             </tr>
             <tr>
                 <th>房源图片</th>
                 <td>
                     <div class="img-wrap">
                         {if isset($imgList)}
                         {foreach $imgList as $item}
                         <img class="image"  src="__ImagePath__{$item.url}" style="max-width:600px;width:100%;border:1px solid #ddd;display:block;margin-bottom:10px;">
                         {/foreach}
                         {/if}
                     </div>
                 </td>
             </tr>
             <tr>
                 <td colspan="2" class="text-center">
                     <a class="btn btn-default active" href="JavaScript:history.go(-1)">返回</a>
                 </td>
             </tr>
             </tbody>
         </table>
     </div>


 </form>
