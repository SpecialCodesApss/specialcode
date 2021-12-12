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
    {!! Form::model($Wallets_withdrawal, ['method' => 'PATCH','enctype'=>'multipart/form-data','route' => ['wallets_withdrawals.update', $Wallets_withdrawal->id]]) !!}
    <div class="row">
         <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>{{trans("wallets_withdrawals.user_id")}}:</strong>
                                {!!Form::select('user_id', $users, $Wallets_withdrawal->user_id, ['class' => 'form-control'])!!}
                            </div>
                        </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.bank_name")}}:</strong>
                            {!! Form::text('bank_name', $Wallets_withdrawal->bank_name, array('placeholder' => trans("wallets_withdrawals.bank_name"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.account_owner_name")}}:</strong>
                            {!! Form::text('account_owner_name', $Wallets_withdrawal->account_owner_name, array('placeholder' => trans("wallets_withdrawals.account_owner_name"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.iban_number")}}:</strong>
                            {!! Form::text('iban_number', $Wallets_withdrawal->iban_number, array('placeholder' => trans("wallets_withdrawals.iban_number"),'class' => 'form-control')) !!}
                        </div>
                    </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>{{trans("wallets_withdrawals.account_number")}}:</strong>
                {!! Form::text('account_number', $Wallets_withdrawal->account_number, array('placeholder' => trans("wallets_withdrawals.account_number"),'class' => 'form-control')) !!}
            </div>
        </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>{{trans("wallets_withdrawals.withdrawal_amount_required")}}:</strong>
                            {!! Form::text('withdrawal_amount_required', $Wallets_withdrawal->withdrawal_amount_required, array('placeholder' => trans("wallets_withdrawals.withdrawal_amount_required"),'class' => 'form-control')) !!}
                        </div>
                    </div> <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{trans("wallets_withdrawals.money_withdrawal_status")}}:</strong>
                                {!!Form::select('money_withdrawal_status', ['قيد المراجعة'=>'قيد المراجعة','مقبول وجاري التجهير'=>'مقبول وجاري التجهير','تم التحويل'=>'تم التحويل'],$Wallets_withdrawal->money_withdrawal_status, ['class' => 'form-control'])!!}
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
