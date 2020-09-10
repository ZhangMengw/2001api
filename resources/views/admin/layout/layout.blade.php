<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>layout 后台大布局 - Layui</title>
  <link rel="stylesheet" href="/static/css/layui.css">
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->
    <ul class="layui-nav layui-layout-left">
      <li class="layui-nav-item"><a href="">控制台</a></li>
      <li class="layui-nav-item"><a href="">商品管理</a></li>
      <li class="layui-nav-item"><a href="">用户</a></li>
      <li class="layui-nav-item">
        <a href="javascript:;">其它系统</a>
        <dl class="layui-nav-child">
          <dd><a href="">邮件管理</a></dd>
          <dd><a href="">消息管理</a></dd>
          <dd><a href="">授权管理</a></dd>
        </dl>
      </li>
    </ul>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
          贤心
        </a>
        <dl class="layui-nav-child">
          <dd><a href="">基本资料</a></dd>
          <dd><a href="">安全设置</a></dd>
        </dl>
      </li>
      <li class="layui-nav-item"><a href="">退了</a></li>
    </ul>
  </div>

  <div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
     <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      @php $name=Route::currentRouteName();@endphp

        <!--layui-nav-itemed-->
        <li class="layui-nav-item ">
          <a class="" href="javascript:;">商品管理</a>
          <dl class="layui-nav-child">
            <dd><a href="javascript:;">商品添加</a></dd>
            <dd><a href="javascript:;">商品列表</a></dd>

          </dl>
        </li>

        <li @if(strpos($name,'brand')!==false) class="layui-nav-item layui-nav-itemed" @else class="layui-nav-item"@endif>
            <a href="javascript:;">品牌管理</a>
            <dl class="layui-nav-child">
            <dd @if($name=='brand.create') class='layui-this'@endif><a href="/admin/brand/create">品牌添加</a></dd>
            <dd @if($name=='brand.index') class='layui-this'@endif><a href="/admin/brand/index">品牌列表</a></dd>

          </dl>
        </li>
        <li class="layui-nav-item">
                 <a href="">分类管理</a>
            <dl class="layui-nav-child">
            <dd><a href="/admin/brand">分类添加</a></dd>
            <dd><a href="/admin/bindex">分类列表</a></dd>

          </dl>
         </li>
      </ul>
    </div>
  </div>

  <div class="layui-body">
    <!-- 内容主体区域 -->
    <div style="padding: 15px;">@yield("content")</div>
  </div>

  <div class="layui-footer">
    <!-- 底部固定区域 -->
    © layui.com - 底部固定区域
  </div>
</div>
<script src="/static/layui.js"></script>
<script src="/static/js/jquery.js"></script>
<script>
//JavaScript代码区域
@php $name = Route::currentRouteName();@endphp
layui.use('element', function(){
  var element = layui.element;


});

layui.use('form', function(){
  var form = layui.form;


});


@if($name="create" || $name="edit")
layui.use('upload', function(){
      var $ = layui.jquery
      ,upload = layui.upload;

        upload.render({
            elem: '#test10'
            ,url: 'http://2001api.com/admin/brand/uploads' //改成您自己的上传接口
            ,done: function(res){
              layer.msg('上传成功');
              layui.$('#uploadDemoView').removeClass('layui-hide').find('img').attr('src', res.result);
              layui.$("input[name='brand_logo']").val(res.result);
              console.log(res)
            }
          });
    })
@endif

@if($name="index")
$(document).on("click",".del",function(){
    // alert("123");
    var brand_id = $(this).attr("brand_id");
    // alert(brand_id);
    if(confirm("是否确定删除？")){
        $.get("/admin/brand/destroy",{brand_id:brand_id},function(res){
            // console.log(res);
            if(res.code=="000000"){
                // alert(res.msg);
                window.location.reload();
            }
        },"json")
    }

})
//分页
$(document).on("click",".layui-laypage a",function(){
    // alert("123");
    var url = $(this).attr("href");
    // alert(url);
    $.get(url,function(res){
        // console.log(res);
        $("table").html(res);
    })
    return false;
})

//全选
        $(document).on('click','.table-responsive:first',function(){
            var checkedval = $('input[name="checkedall"]').prop('checked');
//            alert(checkedval);
            $('input[name="brandcheck[]"]').prop('checked',checkedval);
            if(checkedval){
                $('.table-responsive:gt(0)').addClass('layui-form-checked');
            }else{
                $('.table-responsive:gt(0)').removeClass('layui-form-checked');
            }
        })

//批量删除
        $(document).on('click','.moredel',function(){
            var ids = new Array();
            $('input[name="brandcheck[]"]:checked').each(function(i,k){
                ids.push($(this).val());
            })
            $.get('/admin/brand/destroys',{brand_id:ids},function (res){
                if(res.code=="000000"){
                    window.location.reload();
                }
            },"json")
        })

//即点即改
$(document).on("click",".span_name",function(){
    // alert("123");
    var brand_name = $(this).text();
    var brand_id = $(this).parent().attr("brand_id");
    $(this).parent().html("<input type='text' class='change_name' value="+brand_name+">");
})
$(document).on("blur",".change_name",function(){
    // alert("123");
    var obj = $(this);
    var brand_name = $(this).val();
    var brand_id = $(this).parent().attr("brand_id");
    var fild = $(this).parent().attr("fild");
    var old_name = $(this).parent().attr("old_name");
    if(brand_name==""){
        obj.parent().html("<span class='span_name'>"+old_name+"</span>");
        return;
    }
    if(brand_name==old_name){
        obj.parent().html("<span class='span_name'>"+old_name+"</span>");
        return;
    }
    var data = {};
    data.brand_name = brand_name;
    data.brand_id = brand_id;
    data.fild = fild;
    $.get(
        "/admin/brand/change",
        {data:data},
        function(res){
            // console.log(res);
            if(res["code"]=="0"){
                obj.parent().html("<span class='span_name'>"+brand_name+"</span>");
            }else{
                alert(res["msg"]);
            }
        }
    );
})
@endif

</script>
</body>
</html>
