<header class="page-header page-header-dark bg-gradient-primary-to-secondary">
    <div class="container-fluid px-4">
        <div class="page-header-content pt-4 pb-4">
            <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                <div class="mt-4">
                    <h1 class="page-header-title">
                        {{ $minisite->name }}
                    </h1>
                    <p>{{ $minisite->description }}</p>
                </div>
                <div>
                    <img style="width: 120px; border-radius: 50% !important" src="{{ asset('/backend/minisite/logo/'.$minisite->logo) }}">
                </div>
            </div>
        </div>
    </div>
</header>