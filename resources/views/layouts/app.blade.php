@include('themes::web.default.main.header')

@include('themes::web.default.main.footer')


<script>
    function deleteItem(form_id){
        if (confirm("{{trans('admin.deleteConfirm')}}")) {
            document.getElementById(form_id).submit();
        }
        return false;
    }
</script>
