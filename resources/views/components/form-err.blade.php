@props(['name'])
@error($name)
<p class="text-danger fw-bold mt-1">{{$message}}</p>
@enderror
