<?php

namespace App\Http\Requests;

use App\Attributes\Length;
use Illuminate\Foundation\Http\FormRequest;
use App\Attributes;

class AddCriteriaRequest extends FormRequest
{

    #[Attributes\Length(min:3, max:50)]
    #[Attributes\NotBlank]
    public ?string $name;

    #[Attributes\Length(min:1, max:10)]
    #[Attributes\NotBlank]
    public ?string $description;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'require|string|min:3|max:10',
            'description' => 'require|string|min:1|max:10',
        ];
    }
}
