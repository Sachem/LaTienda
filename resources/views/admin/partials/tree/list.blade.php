<li>

    @if(count($list['children']))

    <a class="expand" data-children="{{ count($list['children']) }}">[+]</a>

    @endif

    @include('admin.partials.tree.item', ['id' => $list['id'], 'name' => $list['name']])

    @if(count($list['children']))

    <ul class="tree-node" style="display: none;">

        @foreach($list['children'] as $child)

            @include('admin.partials.tree.list', ['list' => $child])

        @endforeach

    </ul>

    @endif

</li>