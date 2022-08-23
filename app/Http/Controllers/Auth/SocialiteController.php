<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SocialAccount;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    public function hadleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->back();
        }

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        return redirect('/');
    }

    public function findOrCreateUser($userProvider, $provider)
    {
        $account = SocialAccount::where(['provider_name' => $provider, 'provider_id' => $userProvider->id])->first();
        if ($account) {
            return $account->user;
        } else {
            $user = User::where('email', $userProvider->email)->first();
            if (!$user) {
                $user = User::create([

                    'email' => $userProvider->email,

                    'name'  => $userProvider->name,
                ]);
            }
            $user->SocialAccount()->create([
                'provider_id'   => $userProvider->id,
                'provider_name' => $provider,
            ]);
            return $user;
        }
    }
}
