<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
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
     * @return array
     */
    public function rules()
    {
        return [
            'cover'   => request()->isMethod('post') ? 'required|image|mimes:png,jpg,jpeg,gif|max:2048' : 'image|mimes:png,jpg,jpeg,gif|max:2048',
            'title'   => 'required|max:255|unique:posts,title,'.optional($this->post)->id,
            'content' => 'required',
        ];
    }

    public function message()
    {
        return [
            'cover.required'     => 'Cover is required',
            'cover.mimes'        => 'Cover must be an image',
            'cover.max'          => 'Cover must be less than 2MB',
            'title.required'     => 'Title is required',
            'title.max'          => 'Title must be less than 255 characters',
            'title.unique'       => 'Title must be unique',
            'content.required'   => 'Content is required',
        ];
    }
}