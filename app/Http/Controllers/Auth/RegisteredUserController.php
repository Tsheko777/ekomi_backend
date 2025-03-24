<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'accountNumber' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'cellNumber' => ['required', 'numeric', 'digits:10', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'province' => ['required', 'string', 'max:255'],
            'surburb' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'streetNumber' => ['required', 'numeric'],
            'streetName' => ['required', 'string', 'max:255'],
            'idNumber' => ['required', 'numeric', 'digits:13'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'accountNumber' => $request->input('accountNumber'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'cellNumber' => $request->input('cellNumber'),
            'email' => $request->input('email'),
            'province' => $request->input('province'),
            'surburb' => $request->input('surburb'),
            'city' => $request->input('city'),
            'streetNumber' => $request->input('streetNumber'),
            'streetName' => $request->input('streetName'),
            'idNumber' => $request->input('idNumber'),
            'dob' => $this->extractDateOfBirth($request->input('idNumber')),
            'password' => Hash::make($request->input('password')),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return ['message' => 'Account Created'];
    }
    function extractDateOfBirth(string $idNumber): ?string
    {
        // Check if the ID number is valid
        if (strlen($idNumber) !== 13 || !ctype_digit($idNumber)) {
            return null; // Invalid ID number
        }
        // Extract year, month, and day
        $year = substr($idNumber, 0, 2);
        $month = substr($idNumber, 2, 2);
        $day = substr($idNumber, 4, 2);
        // Determine the century
        $currentYear = (int) date('Y');
        $century = ($year + 2000 <= $currentYear) ? '20' : '19';
        // Format the full date of birth
        $fullYear = $century . $year;
        $dob = "{$fullYear}-{$month}-{$day}";
        return $dob; // Invalid date
    }
}
