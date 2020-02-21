<?php

namespace App\Http\Requests;

use App\Http\Controllers\API\BaseController;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CarRequest
 * @package App\Http\Requests
 */
class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     * @throws \Exception
     */
    public function rules()
    {
        return [
            'marca'     => 'string',
            'modelo'    => 'string|required_if:marca',
            'an_min'    => 'integer|digits_between:1930,' . (new Carbon())->year,
            'ano_max'   => 'integer|digits_between:1930,' . (new Carbon())->year,
            'preco_min' => 'integer|digits_between:2000,2000000',
            'preco_max' => 'integer|digits_between:2000,2000000',
            'km_min'    => 'integer|digits_between:0,2000000',
            'km_max'    => 'integer|digits_between:0,2000000',
            'page'      => 'integer'
        ];
    }

    /**
     * Handle a failed validation attempt.
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        $baseController = new BaseController();

        throw new HttpResponseException(
            $baseController->sendError('Validation error', $errors, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
