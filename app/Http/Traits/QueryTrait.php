<?php

namespace App\Http\Traits;

trait QueryTrait
{
    public function filterOneColumnDateRelation($query, $request, $relation, $column = 'date')
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        return $query->whereRelation($relation, function ($query) use ($start_date, $end_date, $column) {
            $query->whereBetween($column, [$start_date, $end_date]);
        });
    }

    public function filterOneColumnDate($query, $request, $column = 'date')
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        return $query->where(function ($query) use ($start_date, $end_date, $column) {
            $query->whereBetween($column, [$start_date, $end_date]);
        });
    }

    public function filterTwoColumnDate($query, $request, $column = ['start_date', 'end_date'])
    {
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date = date('Y-m-d', strtotime($request->end_date));
        return $query->where(function ($query) use ($start_date, $end_date, $column) {
            $query->whereBetween($column[0], [$start_date, $end_date]);
            $query->orWhereBetween($column[1], [$start_date, $end_date]);
        });
    }

    public function filterByFullName($query, $full_name)
    {
        $keywords = collect(explode(' ', $full_name));
        return $keywords->map(function ($keyword) use ($query) {
            $query->where('first_name', 'like', '%' . $keyword . '%');
            $query->orWhere('last_name', 'like', '%' . $keyword . '%');
        });
    }
}
