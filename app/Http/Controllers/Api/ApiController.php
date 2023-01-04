<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SubCat;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class ApiController extends Controller
{
    public function login(Request $request){
        $input=$request->only('email','password');
        $jwt_token=JWTAuth::attempt($input);
        if($jwt_token){
            return response()->json([
              'con'=>true,
              'msg'=>'success',
              'data'=>$jwt_token
            ]);
        }else{
            return response()->json([
                'con'=>false,
                'msg'=>'Creditial Error',

            ]);
        }

    }

    public function register(Request $request){

      $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required|email',
        'phone'=>'required|digits_between:7,11',
        'password'=>'required',
        'password2'=>'required|same:password'

      ]);

        if($validator->fails()){
            return response()->json([
                'con'=>false,
                'msg'=>'Data Error',


            ]);
        }
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json([
            'con'=>true,
            'msg'=>'Register Success,Please Login',


        ]);



    }
    public function me(){
        return response()->json([
            'con'=>true,
            'msg'=>'Your Info',
            'data'=>auth()->user()

        ]);
    }
    public function cats(){
        $cats=Category::get()->load('subcats');
        return response()->json([
            'con'=>true,
            'msg'=>'All Categories',
            'data'=>$cats

        ]);
    }

    public function subcats($id){
        $subcats=SubCat::where('Category_id',$id)->get();
        return response()->json([
            'con'=>true,
            'msg'=>'All SubCategories',
            'data'=>$subcats
        ]);
    }

    public function tags(){
        $tags=Tag::all();
        return response()->json([
            'con'=>true,
            'msg'=>'All TagCategories',
            'data'=>$tags
        ]);
    }

    public function products(Request $request){
        $products=Product::simplePaginate(2);
        return response()->json([
            'con'=>true,
            'msg'=>'All Products',
            'data'=>$products
        ]);
    }

    public function getProductByCategory(Request $request,$id){
        $products=Product::where('category_id',$id)->simplePaginate(2);
        return response()->json([
            'con'=>true,
            'msg'=>'All ProductByCategories',
            'data'=>$products

        ]);

    }
    public function getProductBySubcat(Request $request,$id){
        $products=Product::where('subcat_id',$id)->simplePaginate(2);
        return response()->json([
            'con'=>true,
            'msg'=>'All ProductBySubCategories',
            'data'=>$products

        ]);

    }

    public function getProductByTag(Request $request,$id){
        $products=Product::where('tag_id',$id)->simplePaginate(2);
        return response()->json([
            'con'=>true,
            'msg'=>'All ProductByTag',
            'data'=>$products,
            'count'=>Product::count()

        ]);

    }

    public function setOrder(Request $request){
        $orders=$request->orders;
        $orderId=$this->saveOrder($orders);
        foreach($orders as $odr){
            $product=Product::find($odr['id']);
            $orderItem=new OrderItem();
            $orderItem->order_id=$orderId;
            $orderItem->user_id=auth()->user()->id;
            $orderItem->category_id=$product->category_id;
            $orderItem->subcat_id=$product->subcat_id;
            $orderItem->tag_id=$product->tag_id;
            $orderItem->name=$product->name;
            $orderItem->price=$product->price;
            $orderItem->images=$product->images;
            $orderItem->color=$product->colors;
            $orderItem->size=$product->sizes;
            $orderItem->count=$odr['count'];
            $orderItem->total=$product->price* $odr['count'];

            $orderItem->save();
        }
        return response()->json([
            'con'=>true,
            'msg'=>'All Order Save',


        ]);

    }

    public function saveOrder($orders){
        $order=new Order();
        $total=0;
        foreach($orders as $odr){
           $product=Product::find($odr['id']);
           $total+=$product->price*$odr['count'];
        }
        $order->user_id=auth()->user()->id;
        $order->count=count($orders);
        $order->status=false;
        $order->total=$total;
        $order->save();
        return $order->id;

    }
    public function myorder(Request $request){
        $orders=Order::where('user_id',auth()->user()->id)->get()->load('orderItems');
        return response()->json([
            'con'=>true,
            'msg'=>'All Order',
            'data'=>$orders


        ]);

    }

    public function myorderItems(Request $request,$id){
        $orders=OrderItem::where('order_id',$id)->get();
        return response()->json([
            'con'=>true,
            'msg'=>'All OrderItems',
            'data'=>$orders


        ]);

    }
    public function subcat(){
        $subcats=SubCat::all();
        return response()->json([
            'con'=>true,
            'msg'=>'All OrderItems',
            'data'=>$subcats


        ]);

    }
    public function productByTag($id){
        $tags=Product::where('tag_id',$id)->get();
        return response()->json([
            'con'=>true,
            'msg'=>'All Product By Tags Items',
            'data'=>$tags


        ]);
    }
}
