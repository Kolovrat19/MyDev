<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 02.08.2017
 * Time: 16:01
 */
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{

    public function rules()
    {
        return [
            'category_id' => [_('Category'), 'integer|exists:categories,id'],
            'name' => [_('Name'), 'required|max:255'],
            'source' => [_('Content'), 'required'],
        ];
    }


}