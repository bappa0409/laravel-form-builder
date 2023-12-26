@extends('layouts.app')
@section('title', __('Response View'))
@push('css')
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ __('Form Response View') }}</h6>
                </div>

                <div class="text-end">
                    <a href="{{ route('forms.create') }}">{{ __('Create a Form') }}</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <h5>Form Name: {{$form->title}}</h5>
            <p>Description: {{$form->description}}</p>
            <hr>

            
            
            @foreach($form->responses as $value)
            <div class="card mb-3">
                <div class="card-body">
                    <h6>User Name: {{$value->user->name}}</h6>
                    <hr>
                    @foreach($value->responseFields as $resField)
                        <h6>Questions: <span class="">{{$resField->field->question_name}}</span></h6>
                        <h6>Answer: <span class="">{{$resField->value}}</span></h6>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

@push('js')
@endpush
