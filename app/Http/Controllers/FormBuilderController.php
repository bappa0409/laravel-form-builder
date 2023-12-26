<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormBuildRequest;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormBuilderController extends Controller
{
    public function index()
    {
        $forms = Form::all();
        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store(FormBuildRequest $request)
    {
        DB::beginTransaction();
        try {
            $form = new Form();
            $form->title = $request->title;
            $form->description = $request->description;
            $form->save();
    
            $questions = $request->question_name;
            for ($i = 0; $i < count($questions) ; $i++) { 
                $formField = new Field();
                $formField->form_id = $form->id;
                $formField->question_name = htmlentities($request->question_name[$i]);
                $formField->type = $request->type[$i];
                $formField->options = json_encode($request->options[$i]);
                $formField->required = $request->required[$i];
                $formField->save();
            }

            DB::commit();
            return redirect()->route('forms.index')->with('success', 'Form created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return redirect()->back()->with('fail', 'Error!');
        }
    }
}
