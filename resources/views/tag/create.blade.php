@extends('layouts.base')
@section('title','Create Tag Page')
@section('content')
  <h1 class="text-center text-info my-5">Create Tag Page</h1>
   <div class="col-md-6 offset-md-3">
    {{-- image into form data --}}
  <form action="{{route('tags.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <x-input name="name" type="text" r="required" />
    <x-input name="image" type="file" r="required" />
    <button type="submit" class="btn btn-primary btn-sm float-end">Create</button>
  </form>
   </div>
@endsection
