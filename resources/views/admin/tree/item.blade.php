<ul>
    @foreach($position->allChildren as $child)
        <a href="#">{{$child->name}}</a>
        @if($child->allChildren)
            @include('admin.tree.list',['items'=>$child->allChildren])
        @endif
    @endforeach
</ul>
