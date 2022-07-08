<?php

namespace App\Http\Controllers\Profile;

use App\Exceptions\HttpQueryException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\AbsenceRequest;
use App\Http\Resources\Absence\AbsenceResource;
use App\Models\Absence;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Http\Traits\Absence as AbsenceTrait;
use App\Models\User;

class AbsenceController extends Controller
{
    use AbsenceTrait;

    public function index(User $user)
    {
        $days = $this->calculateUserDeservedDays($user);

        return [
            'stats' => [
                'deserved' => $days[0],
                'used' => $days[1]['sum_days'],
                'remaining' => $days[0] - $days[1]['sum_days'],
            ],
            'data' => AbsenceResource::collection($user->absence->load('type')),
        ];
    }

    public function store(AbsenceRequest $request, User $user)
    {
        $days = $this->calculateUserDeservedDays($user);
        $dates = $this->checkValidDateRange($request->date, [$request->start_time, $request->end_time]);
        // return $this->dedectConflictingDates($dates, $user_id);
        $calculated_days = Carbon::parse($dates['start_date'])->diffInDays(Carbon::parse($dates['end_date'])) + 1;

        $remainig = $days[0] - $days[1]['sum_days'];

        if ($calculated_days > $remainig) {
            throw new HttpQueryException(trans('messages.over_absence_days', ['day' => $calculated_days - $remainig]));
        }

        try {
            $data = Absence::with('type')->create([
                "user_id" => $user->id,
                "type_id" => $request->type_id,
                "start_date" => $dates['start_date'],
                "end_date" => $dates['end_date'],
                "day_type" => $request->day_type,
                "start_time" => $dates['start_time'],
                "end_time" => $dates['end_time'],
                "status" => $request->status,
                "contact_phone" => $request->contact_phone,
                "place" => $request->place,
                "status" => $request->status,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException(trans('messages.error_added', ['attr' => 'messages.absence']));
        }

        return $this->storeSuccessfully(trans('messages.absence'), new AbsenceResource($data->load('type', 'user')));
    }

    public function update(AbsenceRequest $request, $user_id, Absence $absence)
    {
        try {
            $dates = $this->checkValidDateRange($request->date, [$request->start_time, $request->end_time]);

            $absence->update([
                "type_id" => $request->type_id,
                "start_date" => $dates['start_date'],
                "end_date" => $dates['end_date'],
                "day_type" => $request->day_type,
                "start_time" => $dates['start_time'],
                "end_time" => $dates['end_time'],
                "status" => $request->status,
                "contact_phone" => $request->contact_phone,
                "place" => $request->place,
                "status" => $request->status,
            ]);
        } catch (\Throwable $th) {
            throw new HttpQueryException(trans('messages.absence'));
        }

        return $this->updateSuccessfully(trans('messages.absence'), new AbsenceResource($absence->load('type', 'user')));
    }

    public function destroy($user_id, Absence $absence)
    {
        $absence_count = $this->calculateDays($absence);
        $absence->delete();

        return $this->deleteSuccessfully(trans('messages.absence'), ['absence_count' => $absence_count]);
    }
}
