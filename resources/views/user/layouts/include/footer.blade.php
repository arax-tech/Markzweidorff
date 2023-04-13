@php
    error_reporting(0);
    $setting = DB::table('settings')->where('id', 1)->first();
@endphp

<footer class="footer-admin mt-auto footer-light">
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-6 small">{{ $setting->copyright }}</div>
            <div class="col-md-6 text-md-end small">
                
            </div>
        </div>
    </div>
</footer>
