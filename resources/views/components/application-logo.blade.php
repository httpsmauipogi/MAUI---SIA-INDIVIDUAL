<div {{ $attributes->merge(['class' => 'text-center']) }}>
    @if (site_setting('logo_path'))
        <img src="{{ asset('storage/' . site_setting('logo_path')) }}" alt="{{ site_setting('site_name', 'Healix HMS') }}" style="max-height: 50px; display: inline-block;">
    @else
        <span style="font-size: 1.75rem; font-weight: 700; color: #3454d1;">{{ site_setting('site_name', 'Healix HMS') }}</span>
    @endif
</div>
