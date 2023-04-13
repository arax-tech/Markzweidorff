<header class="header">
    <div class="main-bar">
        <div class="container">
            <div class="header-content">
                <div class="left-content">
                    <a href="javascript:void(0);" class="back-btn">
                        <svg width="18" height="18" viewBox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"/>
						</svg>
                    </a>
                </div>
                <div class="mid-content">
                    <h5 class="mb-0">@yield('header-title')</h5>
                </div>
                <div class="right-content">
                    <a href="{{ url('/pwa/pri/document/download/pdf/'.$document->id) }}" class="btn btn-primary btn-sm btn-rounded">
						<i style="width: 18px; height: 18px" data-feather="download"></i>&nbsp;Download
					</a>
                </div>
            </div>
        </div>
    </div>
</header>