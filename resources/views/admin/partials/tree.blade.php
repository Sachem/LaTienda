<div id="entity-tree">

    <ul class="tree-list">

        @foreach($list as $child)

            @include('admin.partials.tree.list', ['list' => $child])

        @endforeach

    </ul>

</div>

<script>
    
       
    function deselectAll(elements, callback)
    {
        $(elements).attr('checked', false);
        
        callback();
    }

    $(document).ready(function(){
        $('a.expand').click(function() {

            // hide/show children
            $(this).parent().find('ul').first().toggle();

            // toggle +/-
            if($(this).text() == "[+]"){ $(this).text("[-]"); }
            else { $(this).text("[+]"); }

        });
        
        $('input.parent_category_checkbox').click(function() {
            
           //$('input.parent_category_checkbox').attr('checked', false);
           
           deselectAll('input.parent_category_checkbox', function(){
               $(this).attr('checked', true);
           });
           
        });
    });
 

</script>