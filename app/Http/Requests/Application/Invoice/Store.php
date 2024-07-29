<?php

namespace App\Http\Requests\Application\Invoice;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
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
        // Make sure the lenght of product array is the same with other attributes of arrays
        if(!empty($this->product)){
            $max_lenght = count($this->product);
            return [
                'invoice_number' => 'required|unique:invoices,invoice_number',
                'invoice_date' => 'required|date',
                'due_date' => 'required|date',
                'reference_number' => 'nullable|string',
                'driver_id' => 'required',
                'sub_total' => 'required',
                'grand_total' => 'required',
                'notes' => 'nullable|string',
                'private_notes' => 'nullable|string',
    
                'total_discount' => 'sometimes|integer|min:0',
                'total_taxes' => 'sometimes|array|min:0',
    
                'product' => 'required|array|max:'.$max_lenght,
                'product.*' => 'required|integer|exists:products,id',
    
                'quantity' => 'required|array|max:'.$max_lenght,
                'quantity.*' => 'required|min:0',
    
                'price' => 'required|array|max:'.$max_lenght,
                'price.*' => 'required',
    
                'total' => 'required|array|max:'.$max_lenght,
                'total.*' => 'required',
    
                'taxes' => 'sometimes|required|array|max:'.$max_lenght,
                'taxes.*' => 'sometimes|required|array',
    
                'discount' => 'sometimes|required|array|max:'.$max_lenght,
                'discount.*' => 'sometimes|required',
            ];
        }else{
            $max_lenght =0;
            return [
                'invoice_number' => 'required|unique:invoices,invoice_number',
                'invoice_date' => 'required|date',
                'due_date' => 'required|date',
                'reference_number' => 'nullable|string',
                'driver_id' => 'required',
                'sub_total' => 'required',
                'grand_total' => 'required',
                'notes' => 'nullable|string',
                'private_notes' => 'nullable|string',
    
                'total_discount' => 'sometimes|integer|min:0',
                'total_taxes' => 'sometimes|array|min:0',
    
                'product' => 'required|array|max:'.$max_lenght,
                'product.*' => 'required|integer|exists:products,id',
    
                'quantity' => 'required|array|max:'.$max_lenght,
                'quantity.*' => 'required|min:0',
    
                'price' => 'required|array|max:'.$max_lenght,
                'price.*' => 'required',
    
                'total' => 'required|array|max:'.$max_lenght,
                'total.*' => 'required',
    
                'taxes' => 'sometimes|required|array|max:'.$max_lenght,
                'taxes.*' => 'sometimes|required|array',
    
                'discount' => 'sometimes|required|array|max:'.$max_lenght,
                'discount.*' => 'sometimes|required',
            ];
        }
        
    }
 
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'invoice_number.unique' => __('messages.invoice_exists'),
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'invoice_number' => $this->invoice_prefix.'-'.sprintf('%06d', intval($this->invoice_number)),
        ]);
    }
}