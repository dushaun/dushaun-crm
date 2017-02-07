@component('mail::message')
# Hi, {{ $enquiry['name'] }}

Your enquiry has been submitted, I usually get back to enquiries within 1-2 working days so if you have no response
within that time period, feel free to email me quoting your enquiry number: #{{ $enquiry['id'] }}

@component('mail::button', ['url' => ''])
Email
@endcomponent

Thanks,<br>
{{ config('app.admin_name') }}
@endcomponent
