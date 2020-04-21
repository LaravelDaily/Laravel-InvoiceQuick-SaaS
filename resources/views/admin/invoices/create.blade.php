@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.invoice.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.invoices.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="customer_id">{{ trans('cruds.invoice.fields.customer_name') }}</label>
                <select class="form-control select2 {{ $errors->has('customer_id') ? 'is-invalid' : '' }}" name="customer_id" id="customer_id" >
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('customer_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customer_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.customer_name_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="invoice_date">{{ trans('cruds.invoice.fields.invoice_date') }}</label>
                <input class="form-control date {{ $errors->has('invoice_date') ? 'is-invalid' : '' }}" type="text" name="invoice_date" id="invoice_date" value="{{ old('invoice_date') }}" >
                @if($errors->has('invoice_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_date_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="invoice_amount">{{ trans('cruds.invoice.fields.invoice_amount') }}</label>
                <input class="form-control {{ $errors->has('invoice_amount') ? 'is-invalid' : '' }}" type="text" name="invoice_amount" id="invoice_amount" value="{{ old('invoice_amount', '') }}" >
                @if($errors->has('invoice_amount'))
                    <div class="invalid-feedback">
                        {{ $errors->first('invoice_amount') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.invoice.fields.invoice_amount_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
