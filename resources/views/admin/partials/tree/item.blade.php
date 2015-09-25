
<span>{{ $name }}</span>

@if ($category_edit)

    <input type="checkbox" name="{{ $product_edit ? 'category_id' : 'parent_id' }}" value="{{ $id }}" {{ $checked_id == $id ? 'checked' : '' }} class="parent_category_checkbox" />
    
    @if ($parent_id == $id)
    
        <script>
        
        
            // hide/show children
            $(this).parent().find('ul').first().toggle();

            // toggle +/-
            if($(this).text() == "[+]"){ $(this).text("[-]"); }
            else { $(this).text("[+]"); }
        
        
        </script>
    
    @endif

@else

    <a href='{{ url('/admin/catalog/category/'.$id.'/edit') }}'>
        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
    </a>

    <a href='{{ url('/admin/catalog/category/'.$id.'/delete') }}'>
        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
    </a>

@endif


