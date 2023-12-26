@extends('layouts.app')
@section('title', __('Form Builder'))
@push('css')
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ __('Form Builder') }}</h6>
                </div>

                <div class="text-end">
                    <a href="{{ route('forms.create') }}">{{ __('Create a Form') }}</a>
                </div>
            </div>
        </div>

        <div class="card-body">

        </div>
    </div>
@endsection

@push('js')
@endpush
