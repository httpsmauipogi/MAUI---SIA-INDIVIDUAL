{{--
    Reusable breadcrumb/banner block.
    Usage: @include('frontend.partials.banner', ['pageKey' => 'about', 'crumb' => 'About Us', 'default' => 'About Us'])
    Title/subtitle/description are editable from Admin > Page Content.
--}}
@php
    $banner = \App\Models\PageBanner::forPage($pageKey);
    $bannerTitle = $banner->title ?: ($default ?? $crumb);
@endphp

<div id="breadcrumb" class="division">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class=" breadcrumb-holder">

                    <!-- Breadcrumb Nav -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $crumb }}</li>
                        </ol>
                    </nav>

                    <!-- Title -->
                    <h4 class="h4-sm steelblue-color">{{ $bannerTitle }}</h4>

                    @if ($banner->subtitle)
                        <p class="mt-10">{{ $banner->subtitle }}</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>	<!-- END BREADCRUMB -->
