@props(['url'])
<tr>
<td class="header">
{{-- <a href="{{ $url }}" style="display: inline-block;"> --}}
@if (trim($slot) === 'Laravel')
<img src="https://iili.io/HXIGtlj.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
{{-- </a> --}}
</td>
</tr>
