<li>

    @if(count($list['children']))

    <a class="expand" data-children="{{ count($list['children']) }}">[{{ $category_edit == true ? '-' : '+' }}]</a>

    @endif

    @include('admin.partials.tree.item', ['id' => $list['id'], 'name' => $list['name']])

    @if(count($list['children']))

    <ul class="tree-node" style="display: {{ $category_edit == true ? 'block' : 'none' }};">

        @foreach($list['children'] as $child)

            @include('admin.partials.tree.list', ['list' => $child])

        @endforeach

    </ul>

    @endif

</li>