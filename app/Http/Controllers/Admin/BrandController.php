<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand_name = request()->get("brand_name");
        $brand_url = request()->get("brand_url");
        $where = [];
        if($brand_name){
            $where[] = ["brand_name","like","%$brand_name%"];
        }
        if($brand_url){
            $where[] = ["brand_url","like","%$brand_url%"];
        }
        $where[] = ["is_del","=",1];
        $brand = Brand::where($where)->orderBy("brand_id","desc")->paginate("2");
        // dd($brand);
        if(request()->ajax()){
            return view("admin.brand.brandpage",compact("brand","brand_name","brand_url"));
        }
        return view("admin.brand.index",compact("brand","brand_name","brand_url"));
    }

    //即点即改
    public function change(Request $request){
        $arr = $request->all();
        $brand = Brand::where("brand_name",$arr["data"]["brand_name"])->first();
        if($brand){
            return [
                "code"=>1,
                "msg"=>"该品牌已存在",
            ];
        }
        $res = Brand::where("brand_id",$arr["data"]["brand_id"])->update([$arr["data"]["fild"]=>$arr["data"]["brand_name"]]);
        if($res){
            return [
                    "code"=>0,
                    "msg"=>"修改成功",
                ];

        }else{
            return [
                    "code"=>1,
                    "msg"=>"修改失败",
                ];

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.brand.create");
    }

    public function uploads(Request $request){
        // echo "123";
        if ($request->hasFile("file") && $request->file("file")->isValid()) {
            $file = request()->file;
            //将图片保存到文件里
            $store_result = $file->store("uploads");
            $data = env("UPLOADS_URL").$store_result;
            return json_encode(["code"=>0,"msg"=>"上传成功","result"=>$data]);
        }
        return json_encode(["code"=>1,"msg"=>"撒谎给你穿失败"]);
        // dd($file);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->except("_token");

        $validator = Validator::make($arr,
                    [
                    'brand_name' => 'required|unique:brand',
                    'brand_url' => 'required',
                    ],[
                            'brand_name.required'=>'品牌名称为空',
                            'brand_name.unique'=>'品牌名称已存在',
                            'brand_url.required'=>'品牌路径不能为空',
                        ]

                );
                    if ($validator->fails()) {
                        return redirect('/admin/brand/create')
                        ->withErrors($validator)
                        ->withInput();
                        }

        // dd($arr);
        $res = Brand::create($arr);
        if($res){
            return redirect("/admin/brand/index");
        }else{
            return redirect("/admin/brand/create");
        }
    }

    public function Upload($img){
        //判断过程中是否有错误
        if(request()->file($img)->isValid()){
            //文件上传
            $file = request()->file($img);
            //将图片保存到文件里
            $store_result = $file->store("uploads");
            //将最后的文件信息返回
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where("brand_id",$id)->first();
        // dd($brand);
        return view("admin.brand.edit",compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $arr = $request->except("_token");
        // dd($arr);
        $res = Brand::where("brand_id",$arr["brand_id"])->update($arr);
       if($res){
           return redirect("/admin/brand/index");
       }else{
           return redirect("/admin/brand/index");
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        // dd($id);
        $id = request()->get("brand_id");
       //dd($id);

            $res = Brand::where("brand_id",$id)->update(["is_del"=>0]);


        if($res){
                    $message = [
                        'code'=> '000000',
                        'msg'=>'删除成功',
                        'url'=>'/admin/bindex'
                    ];
                    return json_encode($message,JSON_UNESCAPED_UNICODE);
                }else{
                    $message = [
                        'code'=> '000001',
                        'msg'=>'删除失败',
                    ];
                    return json_encode($message,JSON_UNESCAPED_UNICODE);
                }
    }
    public function destroys()
    {
        // dd($id);
        $id = request()->brand_id;
          //dd($id);

            foreach($id as $k=>$v){
                $res = Brand::where("brand_id",$v)->update(["is_del"=>0]);
            }


        if($res){
                    $message = [
                        'code'=> '000000',
                        'msg'=>'删除成功',
                        'url'=>'/admin/bindex'

                    ];
                    return json_encode($message,JSON_UNESCAPED_UNICODE);
                }else{
                    $message = [
                        'code'=> '000001',
                        'msg'=>'删除失败',

                    ];
                    return json_encode($message,JSON_UNESCAPED_UNICODE);
                }
    }
}
