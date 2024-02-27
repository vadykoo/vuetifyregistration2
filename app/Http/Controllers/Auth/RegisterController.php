<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;

class RegisterController extends Controller
{
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(RegisterRequest $registerRequest)
    {
        $registerData = $registerRequest->validated();
        $user = User::create([
            'full_name' => $registerData['fullName'],
            'email' => $registerData['email'],
        ]);

        $country = Country::firstOrCreate(
            ['country' => $registerData['selectedCountry']]
        );
        $user->countries()->attach($country->id);

        $cleanNumber = preg_replace("/\D+/", "", $registerData['phoneNumber']);
        $phone = $user->phone()->create(['number' => $cleanNumber]);
        $user->phone_book_id = $phone->id;
        $user->save();

        event(new UserRegistered($user));

        return new UserResource($user);
    }
}
