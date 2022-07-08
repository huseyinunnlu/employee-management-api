<?php

namespace App\Http\Resources\Admin\Expense;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'expense_id' => $this->expense_id,
            'type' => $this->whenLoaded('type')->title ?? null,
            'type_id' => $this->whenLoaded('type')->id ?? null,
            'date' => format_date($this->date, config('app.date_format')),
            'file' => generate_file_url($this->file ?? null),
            'desc' => $this->desc,
            'price' => $this->price,
        ];
    }
}
