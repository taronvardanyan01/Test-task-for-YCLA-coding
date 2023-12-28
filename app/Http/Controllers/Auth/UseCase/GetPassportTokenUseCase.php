<?php

namespace App\Http\Controllers\Auth\UseCase;

use Illuminate\Support\Facades\Http;

class GetPassportTokenUseCase
{
    public function run(string $email, string $password): array
    {
        try {
            $response = Http::asForm()->post(env('PASSPORT_LOGIN_ENDPOINT'), [
                'grant_type' => 'password',
                'client_id' => env('PASSPORT_CLIENT_ID'),
                'client_secret' => env('PASSPORT_CLIENT_SECRET'),
                'username' => $email,
                'password' => $password,
                'scope' => '*',
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            info($e->getMessage() . 'for user with email: ' . $email);

            throw $e;
        }
    }
}
