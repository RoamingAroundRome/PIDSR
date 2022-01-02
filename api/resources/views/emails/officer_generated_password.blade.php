@component('mail::message')
# Invitation

Hello {{ $officer->first_name }},

An account has been created for you for PIDSR.

This is the generated password:
### {{ $generatedPassword }}

@component('mail::button', ['url' => 'https://pidsr.netlify.com/'])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
