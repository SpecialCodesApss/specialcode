
@include('themes::admin.admindek.main.header')

@include('themes::admin.admindek.main.footer')



<script>
    function deleteItem(form_id){
        if (confirm("{{trans('admin_messages.deleteConfirm')}}")) {
            document.getElementById(form_id).submit();
        }
        return false;
    }
</script>
