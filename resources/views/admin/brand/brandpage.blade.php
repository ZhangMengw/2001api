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
                <th> <input type="checkbox" name="brandcheck[]"  lay-skin="primary"   value="{{$v->brand_id}}"></th>
				<th style="padding-left:20px;">{{$v->brand_id}}</th>
				<th brand_id="{{$v->brand_id}}" fild="brand_name">
				    <span class="span_name">{{$v->brand_name}}</span>
				</th>
				<th>{{$v->brand_url}}</th>
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
