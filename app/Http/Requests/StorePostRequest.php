<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

/**
 * Prepare the data for validation.
 *
 * @return void
 */
protected function prepareForValidation()
{
    
    if($this->tags === null) {
        $tag = 0;
        return $tag;
    }
    $this->merge([
        "tags" =>  array_filter($this->tags, function($tag) {
            
            return !empty($tag['name']);  
        })
    ]);
}

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'user_id' => ['required', 'numeric'],
            'categories_id' => ['required', "numeric"],
            'description' => ['required', 'string'],
            'tags.*.name' => ['required', 'string', 'min:3', 'max:20', 'regex:/^[a-zA-Z][a-zA-Z\d\-]+[a-zA-Z\d]$/'],
            'tags.*.color' => ['exclude_if:tags.*.name,null', 'required'],
        ];
    }

    /*
    *
    * Get the error messages that apply to the defined validation rules
    *
    */
    public function messages() 
    {
        return [
            'tags.*.name.required' => 'Input a name.',
            'tags.*.name.string' => 'Dont just input numbers.',
            'tags.*.name.min' => 'Name length cannot be lower than 3',
            'tags.*.name.max' => 'Name length cannot be higher than 20',
            'tags.*.name.regex' => 'Please make sure to start with and end with a letter. (You can use - as a space)',
            'tags.*.color.required' => 'Dont even know how you managed to get this error, but good job.',
        ];
    }
}
