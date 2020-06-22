@foreach($image as $image)
<img src="{{URL::to('/')}}/images/{{$image->image}}" class="img-thumbnail" width="40px"/>
@endforeach