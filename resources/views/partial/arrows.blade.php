
@foreach ($children as $tag)
@if ($group->tags->contains('id', $tag->id))

<span>>{{$tag->TITLE}} </span>
@if($tag->children->isNotEmpty())
@include('partial.arrows', ['children' => $tag->children])
@else
<input type="hidden" name="tag" value="{{$tag->id}}">
@break
@endif
@endif

@endforeach