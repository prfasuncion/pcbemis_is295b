<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://www.pcbzambales.com/home/images/logo.png" class="logo" alt="" style="width: auto;">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
