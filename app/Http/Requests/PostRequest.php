<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/*意味: 【PostRequestクラス】は、LaravelのFormRequestクラスを継承しています。
【FormRequest】は、HTTPリクエストのバリデーションを行うために使われるLaravelの組み込みクラスです。
•役割: このクラス内で、フォームから送信されたデータのバリデーションロジックを定義します。*/
class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /*public function authorize(): bool
	•意味: authorizeメソッドは、そのリクエストを行ったユーザーがその操作を行う権限を持っているかどうかを決定します。*/

    /*役割: もしauthorizeメソッドがtrueを返す場合、リクエストは許可され、バリデーションが進行します。
    falseを返した場合、そのリクエストは拒否されます。通常、ユーザー認証や特定の権限チェックを行うために使用されます。*/
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
        'title' => 'required',
        'content' => 'required'
        ];
    }
}
