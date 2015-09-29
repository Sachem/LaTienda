<div id="entity-tree">

    <ul class="tree-list">
        
        
        @unless ($product_edit)
        
        <li>
            <span>Root</span>

            @if ($category_edit)
            <input type="checkbox" name="parent_id" value="0" {{ $checked_id === 0 ? 'checked' : '' }} class="parent_category_checkbox" />
            @endif
            
            <ul>
                
        @endunless        

            @foreach($list as $child)

                @include('admin.partials.tree.list', ['list' => $child])

            @endforeach

        @unless ($product_edit)
        
            </ul>
            
        </li>
        
        @endunless

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