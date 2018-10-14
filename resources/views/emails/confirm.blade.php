@component('mail::message')
# Hola {{ $user->name }}

Has cambiado de correo electrónico. Es necesario verificarla con el siguiente botón: 

@component('mail::button', ['url' => route(route('verify',$user->verification_token))])
Confirmar mi cuenta
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent