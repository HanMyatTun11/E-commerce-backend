@extends('layouts.base')
@section('title','Order Page')
@section('content')
  <h1 class="text-center text-info my-2">All Order Page</h1>
   <div class="col-md-8 offset-md-2">
        <table class="table table-bordered">
            <thead>
                <tr class="bg-dark text-white">
                    <th>NO.</th>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Total</th>
                    <th>Items</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order )
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{Auth::user()->name}}</td>
                        <td>{{$order->count}}</td>
                        <td>{{$order->total}}</td>
                        <td>
                            <a href="{{route('orderItem-byid',$order->id)}}" class="btn btn-info btn-sm"><i class="material-icons">visibility</i></a>
                        </td>
                        <td>
                            <form action="{{route('order-status-change',$order->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <button class="btn @if ($order->status) btn-success @else btn-danger @endif btn-sm">Toogle</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
   </div>
@endsection
