<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    const PAGE = 'page';
    const SEARCH = 'search';

    public function rules(): array
    {
        return [
            self::PAGE => [
                'nullable',
                'integer',
                'min:1'
            ],
            self::SEARCH => [
                'nullable',
                'string'
            ],
        ];
    }

    public function getSearch(): ?string
    {
        return $this->get(self::SEARCH);
    }

    public function getPage(): int
    {
        return $this->get(self::PAGE) ?? 1;
    }
}
