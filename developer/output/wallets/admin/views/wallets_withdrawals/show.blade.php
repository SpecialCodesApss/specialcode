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
                <a class="btn btn-primary" href="{{ route('wallets_withdrawals.index') }}"> رجوع</a>
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
                            <strong>{{trans("wallets_withdrawals.id")}}:</strong>
                            {!! Form::number('id', $Wallets_withdrawal->id, array('placeholder' => trans("wallets_withdrawals.id"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div></div> <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("wallets_withdrawals.user_id")}}:</strong>
                                {!!Form::select('user_id', ["59","60","61","62","63","1","8","2"], $Wallets_withdrawal->user_id, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.bank_name")}}:</strong>
                            {!! Form::text('bank_name', $Wallets_withdrawal->bank_name, array('placeholder' => trans("wallets_withdrawals.bank_name"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.account_owner_name")}}:</strong>
                            {!! Form::text('account_owner_name', $Wallets_withdrawal->account_owner_name, array('placeholder' => trans("wallets_withdrawals.account_owner_name"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.iban_number")}}:</strong>
                            {!! Form::text('iban_number', $Wallets_withdrawal->iban_number, array('placeholder' => trans("wallets_withdrawals.iban_number"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans("wallets_withdrawals.account_number")}}:</strong>
                {!! Form::text('account_number', $Wallets_withdrawal->account_number, array('placeholder' => trans("wallets_withdrawals.account_number"),'class' => 'form-control','disabled')) !!}
            </div>
        </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.withdrawal_amount_required")}}:</strong>
                            {!! Form::text('withdrawal_amount_required', $Wallets_withdrawal->withdrawal_amount_required, array('placeholder' => trans("wallets_withdrawals.withdrawal_amount_required"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("wallets_withdrawals.money_withdrawal_status")}}:</strong>
                                {!!Form::select('money_withdrawal_status', ['قيد المراجعة'=>'قيد المراجعة','مقبول وجاري التجهير'=>'مقبول وجاري التجهير','تم التحويل'=>'تم التحويل'], $Wallets_withdrawal->money_withdrawal_status, ['class' => 'form-control','disabled'])!!}
                            </div>
                        </div> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.created_at")}}:</strong>
                            {!! Form::text('created_at', $Wallets_withdrawal->created_at, array('placeholder' => trans("wallets_withdrawals.created_at"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div> <div class="col-xs-3 col-sm-3 col-md-3">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.updated_at")}}:</strong>
                            {!! Form::text('updated_at', $Wallets_withdrawal->updated_at, array('placeholder' => trans("wallets_withdrawals.updated_at"),'class' => 'form-control','disabled')) !!}
                        </div>
                    </div>

        

    </div>

            </div>
        </div>
    </div>

    
@endsection
