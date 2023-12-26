<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldResponse;
use App\Models\Form;
use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $form = Form::findOrFail($id);
        $formFields = Field::where('form_id', $id)->get();

        foreach ($formFields as $field) {
            $field->options = json_decode($field->options, true);
        }

        return view('response.response', compact('form', 'formFields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $response = new Response();
            $response->form_id = $id;
            $response->user_id = $request->user_id;
            $response->save();
            
            $fields = $request->field_id;
            for ($i=0; $i < count($fields); $i++) { 

                $fieldResponse = new FieldResponse();
                $fieldResponse->response_id = $response->id;
                $fieldResponse->field_id = $fields[$i];
                $fieldResponse->value = $request->response[$i];
                $fieldResponse->save();
            }
            DB::commit();
            return redirect()->route('forms.index')->with('success', 'Form Submitted Successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
            return redirect()->back()->with('fail', 'Error!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $form = Form::where('id', $id)->with(['fields', 'responses.responseFields', 'responses.user'])->firstOrFail();
        // $user = User::where('id', $form->response->user_id)->first();
        // dd($form->responses->responseFields);
        return view('response.show', compact('form'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
