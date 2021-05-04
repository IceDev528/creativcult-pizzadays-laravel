@component('mail::message')
#{{ $content['title'] }}
{{ $content['body'] }}

@component('mail::button', ['url' => url('/').'/upload/invoice/'.$content['invoice'].'.pdf' ])
{{ $content['button'] }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
