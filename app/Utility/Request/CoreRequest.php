<?php

namespace App\Utility\Request;

use App\Utility\Data\Data;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CoreRequest
 * @package App\Utility\Request
 */
class CoreRequest extends FormRequest
{
    /**
     * Laravel data class for validation
     *
     * @var string
     */
    protected string $dataClass = Data::class;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param null $key
     * @param null $default
     * @return \App\Utility\Data\Data
     */
    public function validated($key = null, $default = null): Data
    {
        return $this->dataClass::from(parent::validated());
    }
}
