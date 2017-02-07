@component('mail::message')
# You have received and Enquiry

{{ $enquiry['name'] }} has submitted an enquiry.
This person/company are interested in having a {{ $product['title'] }} built.

@component('mail::button', ['url' => 'http://dushaun.crm/enquiries/{{ $enquiry["id"] }}'])
View Enquiry
@endcomponent

@endcomponent
