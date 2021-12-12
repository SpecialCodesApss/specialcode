@extends('admin.layouts.app')

@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>إضافة جديد</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('news_favorites.index') }}"> رجوع</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>خطأ!</strong> خطأ في البيانات.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('enctype'=>'multipart/form-data','route' => 'news_favorites.store','method'=>'POST')) !!}
    <input type="text" name="save_type" id="save_type" value="save" class="hidden">
    
    <div class="row">
   
    
    
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_favorites.news_id")}}:</strong>
                                {!!Form::select('news_id', $news, "old('news_id')", ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
                 <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("news_favorites.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, "old('user_id')", ['class' => 'form-control  chosen-select'])!!}
                            </div>
                        </div>
                
   
   
      

        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">حفظ</button>
            <button type="button"  onclick="
                $('#save_type').val('save_and_add_new');
                $('form').submit();
                return false
            " class="btn btn-primary">حفظ وإضافة جديد</button>
        </div>
    </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>
    
 <script>
                                $(document).ready(function() {
                                    $("input").keydown(function(event){
                                        if(event.keyCode == 13) {
                                            event.preventDefault();
                                            $("form").submit();
                                            // return false;
                                        }
                                    });
                                });
                            </script>
                            
    
@endsection
