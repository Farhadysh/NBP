@foreach($items as $position)
    <li>
        <a href="#">{{$position->name}}</a>
        @include('admin.tree.item')
    </li>
@endforeach

