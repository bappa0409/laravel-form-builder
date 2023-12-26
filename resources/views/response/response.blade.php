@extends('layouts.app')
@section('title', __('Form Create'))
@push('css')
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">Form Submit For User</h6>
                </div>
                <div>
                    <a href="{{route('forms.index')}}">Home</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('form_response.store', $form->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <h3>{{ucwords($form->title)}}</h3>
                    <h6>{{ucfirst($form->description)}}</h6>
                </div>
            </div>

            <div class="card-body pt-0">
                @foreach($formFields as $key => $value)
                    <input type="hidden" name="field_id[]" value={{$value->id}}>
                    <input type="hidden" name="user_id" value={{Auth::id()}}>

                    <div class="mb-3">
                        <label class="form-label fw-bolder">{{ucfirst($value->question_name)}}</label>

                        @foreach ($value->options as $keyOption => $option)
                            @if($value->type == 1)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="response[]" value="{{$option}}" id="option_{{$key+1}}_{{$keyOption+1}}" {{$value->required == 1 ? 'required' : ''}}>
                                        <label class="form-check-label" for="option_{{$key+1}}_{{$keyOption+1}}">{{$option}}</label>
                                    </div>
                            
                            @elseif($value->type == 2)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="response[]" value="{{$option}}" id="option_{{$key+1}}_{{$keyOption+1}}">
                                        <label class="form-check-label" for="option_{{$key+1}}_{{$keyOption+1}}">{{$option}}</label>
                                    </div>
                            @elseif($value->type == 3)
                                <input type="text" class="form-control " name="response[]" {{$value->required == 1 ? 'required' : ''}} placeholder="Write here...">
                            @elseif($value->type == 4)
                                <textarea class="form-control" name="response[]" rows="2" {{$value->required == 1 ? 'required' : ''}} placeholder="Write here..."></textarea>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
<script>
    $.validator.addMethod('atLeastOneCheckbox', function(value, element) {
        return $('input[type="checkbox"]:checked', element.form).length > 0;
    }, 'Please select at least one option.');

    // Apply validation to the form
    $('form').validate({
        rules: {
            // Add the "atLeastOneCheckbox" rule to the "response[]" field
            'response[]': {
                atLeastOneCheckbox: true
            }
        },
        errorPlacement: function(error, element) {
            // Adjust the error placement as needed
            error.insertAfter(element);
        }
    });
</script>
@endpush
