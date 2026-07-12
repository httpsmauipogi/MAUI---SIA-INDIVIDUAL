@extends('layouts.frontend')

@section('title', 'Our Gallery - Healix HMS')

@section('content')




			@include('frontend.partials.banner', ['pageKey' => 'gallery', 'crumb' => 'Our Gallery', 'default' => 'Our Gallery'])



	
			<!-- GALLERY-3
			============================================= -->
			<div id="gallery-3" class="gallery-section division">
				<div class="container">


					<!-- GALLERY FILTERING BUTTONS -->
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="gallery-filter mb-60">
			                    <button data-filter="*" class="is-checked">All</button>
			                    <button data-filter=".dental">Dental Care</button>
			                    <button data-filter=".pediatric">Pediatric</button>
			                    <button data-filter=".cardiology">Cardiology</button>
			                </div>
						</div>
					</div>


					<!-- GALLERY IMAGES HOLDER -->
					<div class="row">	
						<div class="col-md-12 gallery-items-list">
							<div class="masonry-wrap grid-loaded">


								<!-- Managed from Admin > Page Content > Gallery > Gallery Images.
								     Use the "Icon" field to set the filter category: dental / pediatric / cardiology (leave blank to show in "All" only) -->
								@foreach ($galleryCards as $card)
							  	<div class="gallery-item {{ $card->icon }}">
									<div class="hover-overlay">

										<!-- Gallery Image -->
										<img class="img-fluid" src="{{ $card->image_path ? asset('storage/' . $card->image_path) : asset('frontend/images/gallery/image-9.jpg') }}" alt="{{ $card->title ?: 'gallery-image' }}" />
										<div class="item-overlay"></div>

										<!-- Image Zoom -->
										<div class="image-zoom">
											<a class="image-link" href="{{ $card->image_path ? asset('storage/' . $card->image_path) : asset('frontend/images/gallery/image-9.jpg') }}" title=""><i class="fas fa-search-plus"></i></a>
										</div>

									</div>
								</div>	<!-- END GALLERY IMAGE -->
								@endforeach


							</div>
						</div>	
					</div>	  <!-- END GALLERY IMAGES HOLDER -->

					
			 	</div>	   <!-- End container -->	
			</div>	<!-- END GALLERY-3 -->




			<!-- FOOTER-1
			============================================= -->
@endsection
