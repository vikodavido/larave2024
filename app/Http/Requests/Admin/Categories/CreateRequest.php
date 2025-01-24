<?php

namespace App\Http\Requests\Admin\Categories;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Permissions\CategoryEnum; 

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    protected $redirectRoute = 'admin.categories.create';

    public function authorize(): bool
    {
        return auth()->user()?->can(CategoryEnum::PUBLISH->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=> ['required', 'string', 'min:2', 'max:255', 'unique:categories,name'],
            'parent_id' => ['nullable', 'numeric', 'exists:categories,id']
        ];
    }
}
