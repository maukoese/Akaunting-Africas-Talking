@extends('layouts.admin')

@section('title',trans('general.send'))

@section('content')
    @if($showBalance)
        <div class="card bg-gradient-info card-stats col-md-3 col-sm-6 col-xs-12">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-white mb-0">{{ trans('general.balance') }}</h5>
                        <span class="font-weight-bold text-white mb-0">{{ $balance }}</span>
                    </div>

                    <div class="col-auto">
                        <div class="icon icon-shape bg-white text-info rounded-circle shadow">
                            <i class="fa fa-money-bill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        {!! Form::open([
            'id' => 'africas-talking',
            'method' => 'POST',
            'route' => 'africas-talking.send',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true,
        ]) !!}
        <div class="card-body">
            <div class="row">
                {{ Form::multiSelectGroup('contact_id', trans_choice('africas-talking::general.customers', 1), 'user', $customers, '', ['required' => 'required', 'change' => 'onChangeContact', 'multiple' => 'multiple'], 'col-md-5') }}

                <div class="col-md-1 form-inline"><span class="text-center">{{ trans('africas-talking::general.or') }}</span></div>

                <div class="form-group col-md-5 required" :class="[{'has-error': form.errors.get('phone')}]">
                    <label for="phone" class="form-control-label">{{ trans('general.phone') }}</label>
                    <vue-tel-input v-model="form.phone" v-bind="bindProps" v-on:country-changed="onCountryChanged"></vue-tel-input>

                    <div class="invalid-feedback d-block"
                         v-if="form.errors.has('phone')"
                         v-html="form.errors.get('phone')">
                    </div>
                </div>

                {{ Form::textareaGroup('message', trans('africas-talking::general.message'),'',null,['rows' => 5,'required' => 'required']) }}
            </div>
        </div>


        @permission('create-africas-talking-send-sms')
        <div class="card-footer">
            <div class="row save-buttons">
                <div class="col-md-12">
                    <a href="{{ route('africas-talking.send') }}" class="btn btn-icon btn-outline-secondary header-button-top">
                        <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                        <span class="btn-inner--text">{{ trans('general.cancel') }}</span>
                    </a>

                    {!! Form::button(
                    '<div v-if="form.loading" class="aka-loader-frame"><div class="aka-loader"></div></div> <span v-if="!form.loading" class="btn-inner--icon"><i class="fas fa-paper-plane"></i></span>' . '<span v-if="!form.loading" class="btn-inner--text">' . trans('general.send') . '</span>',
                    [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'btn btn-icon btn-success button-submit header-button-top', 'data-loading-text' => trans('general.send')]) !!}
                </div>
            </div>
        </div>
        @endpermission

        {!! Form::close() !!}
    </div>


@endsection


@push('scripts_start')
    <script src="{{ asset('modules/AfricasTalking/Resources/assets/js/africas-talking.min.js?v=' . module_version('africas-talking')) }}"></script>
@endpush
