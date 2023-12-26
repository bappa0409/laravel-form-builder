@extends('layouts.app')
@section('title', __('Form Create'))
@push('css')
@endpush
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="fs-17 fw-semi-bold mb-0">{{ __('Form Create') }}</h6>
                </div>

                <div class="text-end">
                    <a href="{{route('forms.index')}}">{{ __('Back To Home') }}</a>
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

        <form action="{{route('forms.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Form Name" value="Form Name" id="form_name" required>
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" id="description" placeholder="Description" rows="2">Description</textarea>
                </div>
            </div>

            <div class="card-body pt-0">
                <div id="question">
                    <div class="card question_body question_body_0 mb-3">
                        <div class="card-body row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="question_name_0" class="form-label">Question Name (1)</label>
                                    <input type="text" name="question_name[]" placeholder="" value="Question Name 1" class="form-control"
                                        id="question_name_0">
                                </div>
                                
                                <div class="option_0">
                                    <div class="option_items_0">
                                        <div class="input-group mb-1">
                                            <span class="input-group-text"><i class="fa-regular fa-circle-dot"></i></span>
                                            <input class="form-control item_0 option_0_0" type="text" value="Option 1" name="options[0][0]" placeholder="Option 1" id="option_0_0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="input_type_0" class="form-label">Input Types</label>
                                <select name="type[]" class="form-select" id="input_type_0" onchange="selectOption(0)">
                                    <option value="1">Multiple Choice</option>
                                    <option value="2">Checkboxes</option>
                                    <option value="3">Short Answer</option>
                                    <option value="4">Paragraph</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-5">
                                    <a href="javascript:void(0)" class="add_more_option_0 me-3" onclick="addMoreOption(0)"><i class="fas fa-plus me-1"></i>Add More Option</a>
                                </div>
                                <div class="col-7 d-flex justify-content-end">
                                    <div class="form-check form-switch required_div_0 me-4">
                                        <input class="form-check-input required-switch" onchange="requiredSwitch(0)" type="checkbox" role="switch" id="required_check_0">
                                        <label class="form-check-label" for="required_check_0">Required</label>
                                        <input type="hidden" class="required_value_0" name="required[]" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <a href="javascript:void(0)" class="add_more_question"><i class="fas fa-plus"></i>Add New Question</a>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
<script>
    
$(".add_more_question").click(function(e) {
    var optionCountAppendRow = 0; 
    var count = $('#question .question_body').length;
    var html = `
        <div class="card question_body question_body_${count} mb-3">
            <div class="card-body row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="question_name_${count}" class="form-label">Question Name (${count +1})</label>
                        <input type="text" name="question_name[]" placeholder="" value="Question Name ${count +1}" class="form-control"
                            id="question_name_${count}">
                    </div>
                    <div class="option_${count}">
                        <div class="option_items_${count}">
                            <div class="input-group mb-1">
                                <span class="input-group-text"><i class="fa-regular fa-circle-dot"></i></span>
                                <input class="form-control item_${count} option_${count}_${optionCountAppendRow}" type="text" name="options[${count}][${optionCountAppendRow}]" placeholder="Option ${optionCountAppendRow +1}" value="Option ${optionCountAppendRow + 1}" id="option_${count}_${optionCountAppendRow}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="input_type_${count}" class="form-label">Input Types</label>
                    <select name="type[]" class="form-select" id="input_type_${count}" onchange="selectOption(${count})">
                        <option value="1">Multiple Choice</option>
                        <option value="2">Checkboxes</option>
                        <option value="3">Short Answer</option>
                        <option value="4">Paragraph</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-5">
                        <a href="javascript:void(0)" class="add_more_option_${count} me-3" onclick="addMoreOption(${count})"><i class="fas fa-plus me-1"></i>Add More Option</a>
                    </div>
                    <div class="col-7 d-flex justify-content-end">
                        <div class="form-check form-switch required_div_${count} me-4">
                            <input class="form-check-input required-switch" onchange="requiredSwitch(${count})" type="checkbox" role="switch" id="required_check_${count}">
                            <label class="form-check-label" for="required_check_${count}">Required</label>
                            <input type="hidden" class="required_value_${count}" name="required[]" value="0">
                        </div>
                        <a href="javascript:void(0)" class="delete-question text-danger"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div> 
    `;
    $("#question").append(html);
});

  
$(document).on('click', '.delete-question', function(events) {
    $(this).parents('.question_body').remove();
});
$(document).on('click', '.delete-option', function(events) {
    $(this).parents('.option-item').remove();
});

function addMoreOption(count){
    var option = $('#input_type_'+count).find(":selected").val();
    var optionCount = $('.item_'+count).length;

    var html ='';
    if(option == 1){
        html += `<div class="option-item input-group mb-1">
                    <span class="input-group-text"><i class="fa-regular fa-circle-dot"></i></span>
                    <input type="text" class="form-control item_${count} option_${count}_${optionCount}" name="options[${count}][${optionCount}]" placeholder="Option ${optionCount + 1}" value="Option ${optionCount + 1}" id="option_${count}_${optionCount}">
                    <span class="input-group-text delete-option text-danger" style="cursor:pointer"><i class="fas fa-trash"></i></span>
                </div>`;  
            
        }else if(option == 2){
            html += `<div class="option-item input-group mb-1">
                        <span class="input-group-text"><i class="fa-regular fa-square"></i></span>
                        <input type="text" class="form-control item_${count} option_${count}_${optionCount}" name="options[${count}][${optionCount}]" placeholder="Option ${optionCount +1}" value="Option ${optionCount + 1}" id="option_${count}">
                        <span class="input-group-text delete-option text-danger" style="cursor:pointer"><i class="fas fa-trash"></i></span>
                    </div>`;
            }
            
    $(".option_items_"+count).append(html);
    optionCount ++;
    
}
function selectOption(count){
    var option = $('#input_type_'+count).find(":selected").val();
    var selectOptionCount  = $('.item_'+count).length; 

    var html = '';
    if (option == 1) {
        html += `<div class="option_items_${count}">
                            <div class="option-item input-group mb-1">
                                <span class="input-group-text"><i class="fa-regular fa-circle-dot"></i></span>
                                <input type="text" class="form-control item_${count} option_${count}_0" name="options[${count}][0]" value="Option 1" placeholder="Option 1" id="option_${count}_0">
                                <span class="input-group-text delete-option text-danger" style="cursor:pointer"><i class="fas fa-trash"></i></span>
                            </div>
                        </div>
                        `;
                $(".add_more_option_"+count).show();  
    }else if(option == 2){
        html += `<div class="option_items_${count}">
                            <div class="option-item input-group mb-1">
                                <span class="input-group-text"><i class="fa-regular fa-square"></i></span>
                                <input type="text" class="form-control item_${count} option_${count}_0" name="options[${count}][0]" value="Option 1" placeholder="Option 1" id="option_${count}_0">
                                <span class="input-group-text delete-option text-danger" style="cursor:pointer"><i class="fas fa-trash"></i></span>
                            </div>
                        </div>
                        `; 
                $(".add_more_option_"+count).show();  
    }else if(option == 3){
        html += `<div class="option_items_${count}">
                        <input type="text" class="form-control item_${count} option_${count}_0" name="options[${count}][0]" value="short_answer" readonly placeholder="Short Answer">
                    </div>
                    `;

                $(".add_more_option_"+count).hide();  
    
    }else if(option == 4){
        html += `<div class="option_items_${count}">
                        <textarea class="form-control item_${count} option_${count}_0" name="options[${count}][0]" value="paragraph" rows="2" readonly>Paragraph</textarea>
                    </div>
                    `;
                $(".add_more_option_"+count).hide();  

    }
    $(".option_"+count).html(html);  
    selectOptionCount++;
}

// $(document).on('change', '.required-switch' onchange="requiredSwitch(0)"  function() {
//     var value = $(this).is(':checked') ? '1' : '0';
//     $(this).attr('value', value);
//     $(this).next('input[name="required[]"]').val(value);

// });

function requiredSwitch(count){
    var value = $('#required_check_'+count).is(':checked') ? 1 : 0;
    $('.required_value_'+count).val(value);
}
</script>
@endpush
