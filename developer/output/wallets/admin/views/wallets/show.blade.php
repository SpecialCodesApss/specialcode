@extends('admin.layouts.app')

@section('content')
    <div class="wrapper_cols">
        <div class="col_page_content">
            <div class="row">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>عرض البيانات  </h2>
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


    <div class="row">
        
                   <div class="col-xs-12 col-sm-12 col-md-12 nopadding">
                   <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("wallets.id")}}:</strong>
                            {!! Form::number('id', $Wallet->id, array('placeholder' => trans("wallets.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div> <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("wallets.user_id")}}:</strong>
                                {!!Form::select('user_id', ["59","60","61","62","63","1","8","2"], $Wallet->user_id, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets.wallet_balance")}}:</strong>
                            {!! Form::text('wallet_balance', $Wallet->wallet_balance, array('placeholder' => trans("wallets.wallet_balance"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("wallets.active")}}:</strong>
                                {!!Form::select('active', ['غير مفعل','مفعل'], $Wallet->active, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("wallets.created_at")}}:</strong>
                            {!! Form::text('created_at', $Wallet->created_at, array('placeholder' => trans("wallets.created_at"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("wallets.updated_at")}}:</strong>
                            {!! Form::text('updated_at', $Wallet->updated_at, array('placeholder' => trans("wallets.updated_at"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
