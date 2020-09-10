@extends("admin.layout.layout")
@section("title","品牌展示")
@section("content")

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 响应式表格</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">商品展示</h1>
<a href="/admin/brand/create" style="float:right;margin-right:40px" type="button" class="btn btn-default">添加</a>
<div class="table-responsive" id="show" style="margin-top:110px;">
    <form action="/admin/brand/index">
        <input type="text" name="brand_name" value="{{$brand_name??''}}" placeholder="请输入商品名称">
        <input type="text" name="brand_url" value="{{$brand_url??''}}" placeholder="请输入商品网址">
        <button type="submit" class="btn btn-info">编辑</button>
    </form>

	<table class="table">
		<thead>
			<tr>
                <th> <input type="checkbox" name="checkedall"  lay-skin="primary"  ></th>
				<th style="padding-left:20px;">品牌id</th>
				<th>品牌名称</th>
				<th>品牌网址</th>
				<th>品牌logo</th>
				<th>品牌描述</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
        @foreach ($brand as $v)
			<tr>
                <th> <input type="checkbox" name="brandcheck[]"  lay-skin="primary"  value="{{$v->brand_id}}"></th>
				<th style="padding-left:20px;">{{$v->brand_id}}</th>
				<th brand_id="{{$v->brand_id}}" fild="brand_name" old_name="{{$v->brand_name}}">
				    <span class="span_name">{{$v->brand_name}}</span>
				</th>
                <th brand_id="{{$v->brand_id}}" fild="brand_url" old_name="{{$v->brand_url}}">
                    <span class="span_name">{{$v->brand_url}}</span>
                </th>
				<th>@if($v->brand_logo)<img src="{{$v->brand_logo}}" width="35px" alt="">@endif</th>
				<th>{{$v->brand_desc}}</th>
				<th>
                <a href="{{url('/admin/brand/edit/'.$v->brand_id)}}" class="btn btn-info">编辑</a>
                <!-- <a href="{{url('/admin/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a> -->
                <a href="javascript:void(0)" class="btn btn-danger del" brand_id="{{$v->brand_id}}">删除</a>
                </th>
			</tr>
        @endforeach
        <tr><td colspan="6">{{$brand->appends(["brand_name"=>$brand_name,"brand_url"=>$brand_url])->links("vendor.pagination.adminbrandshow")}}</td></tr>
		</tbody>
</table>

         <button type="button" class="layui-btn layui-btn-primary moredel">批量删除</button>



</div>

</body>
</html>
@endsection
