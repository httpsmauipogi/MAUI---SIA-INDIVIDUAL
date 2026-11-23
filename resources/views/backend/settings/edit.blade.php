@extends('layouts.backend')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="las la-info-circle me-1"></i> Changes here update the public website (homepage, header, footer, contact pages) immediately. Only Super Admins can access this page.
        </div>
    </div>
</div>

<form method="POST" action="{{ route('admin.settings.website.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-lg-8">

            <!-- General -->
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">General</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="site_name">Site Name</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'Healix HMS') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tagline">Tagline</label>
                            <input type="text" class="form-control" id="tagline" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}" placeholder="e.g. Compassionate Care, Modern Medicine">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="logo">Site Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                            @if (! empty($settings['logo_path']))
                                <div class="mt-2"><img src="{{ storage_url($settings['logo_path']) }}" alt="Current logo" height="40"></div>
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="favicon">Favicon</label>
                            <input type="file" class="form-control" id="favicon" name="favicon" accept="image/*">
                            @if (! empty($settings['favicon_path']))
                                <div class="mt-2"><img src="{{ storage_url($settings['favicon_path']) }}" alt="Current favicon" height="24"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact -->
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Contact Information</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="emergency_phone">Emergency Phone <span class="text-muted">(shown in footer, falls back to Phone if blank)</span></label>
                            <input type="text" class="form-control" id="emergency_phone" name="emergency_phone" value="{{ old('emergency_phone', $settings['emergency_phone'] ?? '') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $settings['email'] ?? '') }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="2">{{ old('address', $settings['address'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Homepage -->
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Homepage Banner</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="hero_title">Hero Title</label>
                            <input type="text" class="form-control" id="hero_title" name="hero_title" value="{{ old('hero_title', $settings['hero_title'] ?? '') }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="hero_subtitle">Hero Subtitle</label>
                            <input type="text" class="form-control" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? '') }}">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="hero_description">Hero Description</label>
                            <textarea class="form-control" id="hero_description" name="hero_description" rows="3">{{ old('hero_description', $settings['hero_description'] ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social -->
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Social Links</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="facebook_url">Facebook URL</label>
                            <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                            @error('facebook_url') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="twitter_url">Twitter / X URL</label>
                            <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}">
                            @error('twitter_url') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="instagram_url">Instagram URL</label>
                            <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                            @error('instagram_url') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="linkedin_url">LinkedIn URL</label>
                            <input type="url" class="form-control @error('linkedin_url') is-invalid @enderror" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url'] ?? '') }}">
                            @error('linkedin_url') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="youtube_url">YouTube URL</label>
                            <input type="url" class="form-control @error('youtube_url') is-invalid @enderror" id="youtube_url" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}">
                            @error('youtube_url') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">Footer</h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label" for="footer_about">Footer About Text</label>
                            <textarea class="form-control" id="footer_about" name="footer_about" rows="3">{{ old('footer_about', $settings['footer_about'] ?? '') }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="copyright_text">Copyright Text</label>
                            <input type="text" class="form-control" id="copyright_text" name="copyright_text" value="{{ old('copyright_text', $settings['copyright_text'] ?? '') }}" placeholder="e.g. Healix HMS. All Rights Reserved">
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end col-->

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h5 class="card-title mb-0">System</h5></div>
                <div class="card-body">
                    <div class="form-check form-switch form-switch-danger mb-2">
                        <input class="form-check-input" type="checkbox" id="maintenance_mode" name="maintenance_mode" value="1" {{ old('maintenance_mode', $settings['maintenance_mode'] ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="maintenance_mode">Maintenance Mode</label>
                    </div>
                    <p class="text-muted fs-13">When enabled, visitors see a "we'll be back soon" page instead of the website. Admin login stays accessible.</p>

                    <button type="submit" class="btn btn-primary w-100 mt-2">Save Changes</button>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
</form>

@endsection
