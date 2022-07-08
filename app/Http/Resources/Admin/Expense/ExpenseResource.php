<?php

namespace App\Http\Resources\Admin\Expense;

use App\Http\Resources\Admin\Reports\ReportUserResource;
use App\Models\Expense;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lines = $this->whenLoaded('lines') ?? [];

        $collected_lines = collect($lines);
        $summed_prices = $collected_lines->pluck('price')->sum();

        return [
            'id' => $this->id,
            'user' => new ReportUserResource($this->whenLoaded('user')),
            'expense_lines' => ExpenseLineResource::collection($lines),
            'status' => $this->status,
            'status_color' => Expense::status_colors[$this->status],
            'notes' => $this->notes,
            'prices' => $summed_prices,
            'created_at' => format_date($this->created_at, config('app.date_time_format')),
        ];
    }
}
