<?php

namespace App\Providers;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ExternalApiUserProvider implements UserProvider
{
    public function retrieveById($identifier)
    {
        // This method is called from subsequent calls until the session expires.
        //
        // As you don't have a local users database we are going
        // to assume the identifier saved into the session is fine.
        //
        // Session cookies are encrypted by default
        //
        // This avoid calling the external service on every navigation.
        //
        // The downside is that if the user is not authorized anymore
        // in the external service, you won't know until their session expires.
        //
        // Ideally you should set a lower session duration so user
        // gets logged out quickier.
        //
        // An alternative is to save encrypted the user's credentials
        // and call the external service every time.
        //
        // But that would make a external API call on every request,
        // making your app slower. But is the most secure way.
        //
        // If you want I can make an modified version exemplifying 
        // how you could do this.
        return new GenericUser([
            'id' => $identifier,
            'nro_documento' => $identifier,
        ]);
    }

    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (! array_key_exists('nro_documento', $credentials)) {
            return null;
        }

        // GenericUser is a class from Laravel Auth System
        return new GenericUser([
            'id' => $credentials['nro_documento'],
            'nro_documento' => $credentials['nro_documento'],
        ]);
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        if (! array_key_exists('password', $credentials)) {
            return false;
        }

        $client = new Client(['headers' => ['Content-Type' => 'application/json']]);
        $datos_login = ['usuario' => $request->get('usuario'), 'clave' => $request->get('clave')];
        $response=$client->post(
            'http://10.0.60.27:8088/guarani/3.18/rest/password-uader', 
            [
 
                'auth' => ['guarani', 'abc123456'],
                'body' => json_encode($datos_login),
            ]
        );

        return $response->ok();
    }
}