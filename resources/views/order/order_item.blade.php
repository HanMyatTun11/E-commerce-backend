@extends('layouts.base')
@section('title','OrderItem Page')
@section('content')
  <h1 class="text-center text-info my-2">All OrderItem Page</h1>
   <div class="col-md-10 offset-md-1">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-dark text-white">
                    <th>NO.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Count</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderitems as $item )
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            @php $images=explode(',',$item->images);@endphp
                            @foreach ($images as $image )
                            <img src="{{url('/uploads/'.$image)}}" alt="" width=50 height=50>
                            @endforeach
                        </td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->count}}</td>
                        <td>{{$item->price * $item->count}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
   </div>
@endsection
