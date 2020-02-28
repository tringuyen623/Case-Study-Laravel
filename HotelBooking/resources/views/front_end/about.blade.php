@extends('front_end.layouts.app')
@section('title', 'About')

@section('content')
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
           <li style="background-image: url({{App\GalleryCategory::where('name','Hotel')->get()->first()->hotelGalleries->random()->image}});">
               <div class="overlay"></div>
               <div class="container-fluid">
                   <div class="row">
                       <div class="col-md-6 col-sm-12 col-md-offset-3 slider-text">
                           <div class="slider-text-inner slider-text-inner2 text-center">
                               <h2>Information</h2>
                               <h1>About Us</h1>
                           </div>
                       </div>
                   </div>
               </div>
           </li>
          </ul>
      </div>
</aside>
<div id="colorlib-about">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about animate-box">
                    <h2>Welcome to our Hotel</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
                    <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their.</p>
                </div>
            </div>
            <div class="col-md-6">
            <img class="img-responsive" src="{{App\GalleryCategory::where('name','Hotel')->get()->first()->hotelGalleries->random()->image}}" alt="Dream Hotel">
            </div>
        </div>
    </div>
</div>
@endsection