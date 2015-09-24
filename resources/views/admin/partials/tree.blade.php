<div id="entity-tree">

    <ul class="tree-list">
        
        
        
        <li>
            <span>Root</span>

            @if ($category_edit)
            <input type="checkbox" name="category[]" value="0" {{ $parent_id == 0 ? 'checked' : '' }} class="parent_category_checkbox" />
            @endif
            
            <ul>

            @foreach($list as $child)

                @include('admin.partials.tree.list', ['list' => $child])

            @endforeach

            </ul>
            
        </li>
        

    </ul>

</div>

<script>
    
 
    $(document).ready(function(){
        $('a.expand').click(function() {

            // hide/show children
            $(this).parent().find('ul').first().toggle();

            // toggle +/-
            if($(this).text() == "[+]"){ $(this).text("[-]"); }
            else { $(this).text("[+]"); }

        });
        
        $('input.parent_category_checkbox').click(function() {
            
           $('input.parent_category_checkbox').not(this).attr('checked', false);
           
        });
    });
 

</script>