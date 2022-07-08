<?php

namespace App\Http\Controllers;

use App\Exceptions\CrudException;
use App\Http\Requests\Profile\EmailUpdateRequest;
use App\Http\Requests\Profile\EmergencyContactRequest;
use App\Http\Requests\Profile\PhotoRequest;
use App\Http\Requests\Profile\UpdatePasswordRequest;
use App\Http\Requests\Profile\UpdatePersonalInfoRequest;
use App\Http\Resources\User\ProfileResource;
use App\Models\EmergencyContact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends Controller
{
    public function get(User $user)
    {
        return new ProfileResource($user->load(
            'company',
            'role',
            'department',
            'manager',
            'work_place',
            'position',
            'job',
            'born_place.country',
            'city.country',
            'emergency_contact',
            'education_info',
            'certificate',
            'foreign_language.language',
            'work_experience',
            'reference'
        ));
    }

    public function updateEmail(EmailUpdateRequest $request, User $user)
    {

        try {
            $user->update([
                'email' => $request->email,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.employee')]));
        }

        return $this->updateSuccessfully(trans('messages.employee'), $user->email);
    }

    public function updatePersonalInfo(UpdatePersonalInfoRequest $request, User $user)
    {
        try {
            $boolean_data = [
                "licence_a1" => false,
                "licence_a2" => false,
                "licence_a" => false,
                "licence_b" => false,
                "licence_c" => false,
                "licence_d" => false,
                "licence_e" => false,
                "licence_f" => false,
                "licence_g" => false,
                "licence_h" => false,
                "licence_k" => false,
                "mon" => false,
                "tur" => false,
                "wed" => false,
                "thu" => false,
                "fri" => false,
                "sat" => false,
                "sun" => false,
            ];

            if (count($request->licences) > 0) {
                foreach ($request->licences as $licence) {
                    $boolean_data['licence_' . $licence] = true;
                }
            }
            if (count($request->work_days) > 0) {
                foreach ($request->work_days as $day) {
                    $boolean_data[$day] = true;
                }
            }
            $update_data = array_merge($boolean_data, $request->post() ?? []);
            $update_data['is_smoking'] = convert_mysql_boolean($request->is_smoking);
            $user->update($update_data);
        } catch (\Throwable $th) {
            return $th;
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.employee')]));
        }

        return $this->updateSuccessfully(trans('messages.employee'), new ProfileResource($user->load(
            'company',
            'role',
            'department',
            'manager',
            'work_place',
            'position',
            'job',
            'born_place.country',
            'city.country',
            'emergency_contact',
            'education_info',
            'certificate',
            'foreign_language.language',
            'work_experience',
            'reference'
        )));
    }

    public function addEmergencyContact(EmergencyContactRequest $request, $user_id)
    {
        try {
            $data = EmergencyContact::create([
                'user_id' => $user_id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_created', ['attr' => trans('messages.employee')]));
        }

        return $this->updateSuccessfully('Employee', [
            'id' => $data->id,
            'user_id' => $data->user_id,
            'full_name' => $data->full_name,
            'phone' => $data->phone,
        ]);
    }

    public function deleteEmergencyContact($user_id, EmergencyContact $emergencycontact)
    {
        $emergencycontact->delete();
        return $this->deleteSuccessfully(trans('messages.employee'));
    }


    public function updatePhoto(PhotoRequest $request, User $user)
    {

        if ($request->hasFile('photo')) {
            $user->photo != '/blank.png' ? $this->deleteOldFile($user->photo) : '';
            $url = $request->photo->store('profile_photos');
        }

        $user->update([
            'photo' => $url,
        ]);

        return $this->updateSuccessfully(trans('messages.profile_photo'), env('ASSET_URL') . $user->photo);
    }

    private function checkOldPassword($password, $old_password)
    {

        if (Hash::check($password, $old_password)) {
            return true;
        }

        throw new CrudException(trans('messages.current_password_is_wrong'));
    }

    public function updatePassword(UpdatePasswordRequest $request, User $user)
    {

        $this->checkOldPassword($request->current_password, $user->password);

        try {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        } catch (\Throwable $th) {
            throw new CrudException(trans('messages.error_updated', ['attr' => trans('messages.employee')]));
        }

        return $this->changeStatusSuccessfully(trans('messages.password'));
    }
}
