<x-mail::message>
# Hello!

Your membership has expired.

Expired Date: {{ $expiredDate }}

<x-mail::button :url="$renewUrl">
	Renew Membership
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
