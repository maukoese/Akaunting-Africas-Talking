@extends('layouts.admin')

@section('title',trans('africas-talking::general.logs'))

@section('new_button')
    @permission('create-sales-invoices')
    <span>
        <a href="{{ route('africas-talking.send') }}" class="btn btn-primary btn-sm btn-success header-button-top">
            <span class="fa fa-paper-plane"></span> &nbsp;
            {{ trans('general.send') }}
        </a>
    </span>
    @endpermission
@endsection

@section('content')

    <div class="card">
        <div class="card-header border-bottom-0">
            {!! Form::open([
                    'method' => 'GET',
                    'route' => 'africas-talking.logs',
                    'role' => 'form',
                    'class' => 'mb-0'
                ]) !!}
            {!! Form::close() !!}
        </div>

        <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block"></th>
                        <th class="col-md-2 col-lg-2 col-xl-2 d-none d-md-block text-left">@sortablelink('id', trans('general.id'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow'])</th>
                        <th class="col-xs-4 col-sm-4 col-md-4 col-lg-2 col-xl-2 text-left">@sortablelink('phone', trans('general.phone'), [], ['class' => 'col-aka'])</th>
                        <th class="col-xs-4 col-sm-4 col-md-4 col-lg-2 col-xl-3 text-left col-aka">{{ trans('africas-talking::general.message') }}</th>
                        <th class="col-lg-1 col-xl-1 d-none d-lg-block text-center">@sortablelink('status', trans_choice('general.statuses', 1))</th>
                        <th class="col-lg-2 col-xl-2 d-none d-lg-block text-left">@sortablelink('created_at', trans('general.date'))</th>
                        <th class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-1 text-center"><a>{{ trans('africas-talking::general.check_status') }}</a></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logs as $log)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block"></td>
                            <td class="col-md-2 col-lg-2 col-xl-2 d-none d-md-block text-left col-aka">
                                {{ $log->process_id }}
                            </td>
                            <td class="col-xs-4 col-sm-4 col-md-4 col-lg-2 col-xl-2 text-left">
                                {{ $log->phone }}
                            </td>
                            <td class="col-xs-4 col-sm-4 col-md-4 col-lg21 col-xl-3 text-left long-texts">
                                {{ $log->message }}
                            </td>
                            <td class="col-lg-1 col-xl-1 d-none d-lg-block text-center">
                                <span class="badge badge-pill badge-{{ $log->statusColor() }}">
                                    {{ trans('africas-talking::statuses.' . $log->status) }}
                                </span>
                            </td>
                            <td class="col-lg-2 col-xl-2 d-none d-lg-block text-left">
                                {{ $log->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-1 text-center">
                                @if($log->shouldCheckStatus())
                                    <a class="btn btn-info btn-sm header-button-top" href="{{ route('africas-talking.logs.checkStatus', $log) }}"><i class="fas fa fa-sync"></i></a>
                                @else
                                    <span class="btn btn-info btn-sm header-button-top disabled"><i class="fas fa fa-sync"></i></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>

        <div class="card-footer table-action">
            <div class="row">
                @include('partials.admin.pagination', ['items' => $logs])
            </div>
        </div>
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/AfricasTalking/Resources/assets/js/africas-talking.min.js?v=' . module_version('africas-talking')) }}"></script>
@endpush
