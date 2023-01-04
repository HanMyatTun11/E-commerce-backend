<div class="mb-3">
    <label for="{{$name}}" class="form-label">
        @php
            echo Str::ucfirst($cn ?? $name);
        @endphp
    </label>
    <input type="{{$type}}" class="form-control @if ($errors->has($name)) is-invalid @endif"  id="{{$name}}" name="{{$name}}" value="{{$value ?? old($name)}}" {{$r ?? ""}} {{$m ?? ""}}>
     @error($name)
    <div id="{{$name}}Help" class="form-text text-danger">{{$errors->first($name)}}</div>
    @enderror
  </div>
