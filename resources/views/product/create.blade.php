@extends('layouts.base')
@section('title','Create Products Page')
@section('content')
  <h1 class="text-center text-info my-2">Create Products Page</h1>
  <div class="col-md-8 offset-md-2">
        <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-1">
                    <x-input name="name" type="text"/>
                </div>
                <div class="col-md-6 mb-1">
                    <label for="category_id" class="form-label">Category </label>
                    <select class="form-select"  name="category_id" id="category_id" onChange="catChange(event)">
                        @foreach ($cats as $cat )
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-1">
                    <label for="subcat_id" class="form-label">SubCategory </label>
                    <select class="form-select"  name="subcat_id" id="subcat_id">

                    </select>
                </div>
                <div class="col-md-6 mb-1">
                    <label for="tag_id" class="form-label">Tag </label>
                    <select class="form-select"  name="tag_id" id="tag_id" onChange="catChange(event)">
                        @foreach ($tags as $tag )
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-1">
                    <x-input name="price" type="number"/>
                </div>
                <div class="col-md-6 mb-1">
                    <x-input name="colors" type="text" cn="colors(ကော်မှာထညါ့ပါ)" />
                </div>
                <div class="col-md-6 mb-1">
                    <x-input name="sizes" type="text" cn="sizes(ကော်မှာထညါ့ပါ)" />
                </div>
                <div class="col-md-6 mb-1">
                    {{-- more images --}}
                    <x-input name="images[]" type="file" m='multiple'/>
                </div>
                <div class="col-md-12 mb-1">
                    <x-textarea name="description" type="text" />
                </div>

            </div>
            <button type="submit" class="btn btn-primary btn-sm  float-end">Create</button>
        </form>
  </div>
@endsection

@push('script')
 <script>
    let cats="{{$cats}}";
    cats=cats.replace(/&quot;/g,"\"");
    cats=JSON.parse(cats);
    //console.log(cats);

    let subcats="{{$subcats}}";
    subcats=subcats.replace(/&quot;/g,"\"");
    subcats=JSON.parse(subcats);

    //onChange event
    let catChange=(e)=>{
      // console.log(e.target.value);
      let cardID=e.target.value;
      //console.log('Card Id',cardID);
       filterSubs(cardID);
    }
    //console.log(cats);
    let filterSubs=(id)=>{
        let subs=subcats.filter((s)=>s.category_id==id);
        let str="";

        for(let sub of subs){
            //console.log(sub);
            str+=`<option value="${sub.id}">${sub.name}</option>`;
        }
        document.querySelector('#subcat_id').innerHTML=str;
    }
    //default category
    filterSubs([cats[0].id]);
 </script>
@endpush
