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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $key => $form)
                        <tr>
                            <th>{{$key + 1}}</th>
                            <td>{{$form->title}}</td>
                            <td>{{$form->description}}</td>
                            <td>
                                <a href="{{route('form_response_view', $form->id)}}" class="btn btn-success btn-sm">View Responses</a>
                                <a href="{{route('form_response', $form->id)}}" class="btn btn-info btn-sm">User Form</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
@endpush
