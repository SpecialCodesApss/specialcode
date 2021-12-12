@extends('admin.layouts.app')

@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2> تعديل البيانات</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('wallets.index') }}"> رجوع</a>
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
    {!! Form::model($Wallet, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['wallets.update', $Wallet->id]]) !!}
    <div class="row">
         <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("wallets.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, $Wallet->user_id, ['class' => 'form-control'])!!}
                            </div>
                        </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets.wallet_balance")}}:</strong>
                            {!! Form::text('wallet_balance', $Wallet->wallet_balance, array('placeholder' => trans("wallets.wallet_balance"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("wallets.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Wallet->active, ['class' => 'form-control'])!!}
                            </div>
                        </div>

        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>
    </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>

    
@endsection
