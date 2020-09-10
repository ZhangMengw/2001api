@extends("admin.layout.layout")
@section("title","品牌添加")
@section("content")
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<h1 align="center" style="margin-top:30px;margin-bottom:40px;">品牌添加</h1>
<a href="/admin/brand/index" style="float:right;margin-right:40px" type="button" class="btn btn-default">展示</a>
<div style="margin-top:110px;">

<!-- @if ($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif -->

<form class="form-horizontal" action="/admin/brand/update" onSubmit="return but();" method="post" enctype="multipart/form-data" role="form" style="width:97%;">
@csrf
<input type="hidden" name="brand_id" value="{{$brand->brand_id}}">
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="brand_name" name="brand_name" value="{{$brand->brand_name}}"
				   placeholder="请输入品牌名称">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="brand_url"  name="brand_url" value="{{$brand->brand_url}}"
				   placeholder="请输入品牌网址">
		</div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="firstname" class="col-sm-2 control-label">品牌logo</label>
            <div class="layui-upload-drag" id="test10">
              <i class="layui-icon"></i>
              <p>点击上传，或将文件拖拽到此处</p>
              <div @if(!$brand->brand_logo) class="layui-hide" @endif id="uploadDemoView">
                <hr>
                <img src="{{$brand->brand_logo}}" alt="上传成功后渲染" style="max-width: 196px">
                <input type="hidden" name="brand_logo" value="{{$brand->brand_logo}}">
              </div>
	</div>
	<div class="form-group" style="width:97%;">
		<label for="lastname" class="col-sm-2 control-label">品牌简介</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="brand_desc" name="brand_desc"placeholder="请输入品牌简介">{{$brand->brand_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改</button>
		</div>
	</div>
</form>
</div>

</body>
</html>

@endsection
