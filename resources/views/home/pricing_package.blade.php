@extends('layouts.home')
@section('title')
    <title>Báo Giá</title>
@endsection
@section('content')
    @include('home.partials.banner')
    <section class="gap">
        <div class="container">
            <div class="package two">
                <div class="package-text">
                    <i><img src="{{asset('home/assets/img/package-1.png')}}" alt="Package"></i>
                    <div>
                        <h4>$120.00 <span>/ Per month</span></h4>
                        <h3>Dog Grooming</h3>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>On site salon</li>
                            <li><i class="fa-solid fa-check"></i>Experienced friendly team</li>
                            <li><i class="fa-solid fa-check"></i>Grooming you can feel good about</li>
                            <li><i class="fa-solid fa-check"></i>Ultimate convenience</li>
                        </ul>
                        <a href="#" class="button">Book Service</a>
                    </div>
                </div>
                <figure>
                    <img src="{{asset('home/assets/img/pricing-1.jpg')}}" alt="Package">
                </figure>
            </div>
            <div class="package two">
                <div class="package-text">
                    <i><img src="{{asset('home/assets/img/package-2.png')}}" alt="Package"></i>
                    <div>
                        <h4>$180.00 <span>/ Per month</span></h4>
                        <h3>Training & Advice</h3>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>On site salon</li>
                            <li><i class="fa-solid fa-check"></i>Experienced friendly team</li>
                            <li><i class="fa-solid fa-check"></i>Grooming you can feel good about</li>
                            <li><i class="fa-solid fa-check"></i>Ultimate convenience</li>
                        </ul>
                        <a href="#" class="button">Book Service</a>
                    </div>
                </div>
                <figure>
                    <img src="{{asset('home/assets/img/pricing-2.jpg')}}" alt="Package">
                </figure>
            </div>
            <div class="package two">
                <div class="package-text">
                    <i><img src="{{asset('home/assets/img/package-3.png')}}" alt="Package"></i>
                    <div>
                        <h4>$80.00 <span>/ Per month</span></h4>
                        <h3>Pet Sitting</h3>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>On site salon</li>
                            <li><i class="fa-solid fa-check"></i>Experienced friendly team</li>
                            <li><i class="fa-solid fa-check"></i>Grooming you can feel good about</li>
                            <li><i class="fa-solid fa-check"></i>Ultimate convenience</li>
                        </ul>
                        <a href="#" class="button">Book Service</a>
                    </div>
                </div>
                <figure>
                    <img src="{{asset('home/assets/img/pricing-3.jpg')}}" alt="Package">
                </figure>
            </div>
            <div class="package two">
                <div class="package-text">
                    <i><img src="{{asset('home/assets/img/package-1.png')}}" alt="Package"></i>
                    <div>
                        <h4>$190.00 <span>/ Per month</span></h4>
                        <h3>Puppy’s Life Care</h3>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>On site salon</li>
                            <li><i class="fa-solid fa-check"></i>Experienced friendly team</li>
                            <li><i class="fa-solid fa-check"></i>Grooming you can feel good about</li>
                            <li><i class="fa-solid fa-check"></i>Ultimate convenience</li>
                        </ul>
                        <a href="#" class="button">Book Service</a>
                    </div>
                </div>
                <figure>
                    <img src="{{asset('home/assets/img/pricing-4.jpg')}}" alt="Package">
                </figure>
            </div>
            <div class="package two">
                <div class="package-text">
                    <i><img src="{{asset('home/assets/img/package-2.png')}}" alt="Package"></i>
                    <div>
                        <h4>$150.00 <span>/ Per month</span></h4>
                        <h3>Sleepover Colors</h3>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>On site salon</li>
                            <li><i class="fa-solid fa-check"></i>Experienced friendly team</li>
                            <li><i class="fa-solid fa-check"></i>Grooming you can feel good about</li>
                            <li><i class="fa-solid fa-check"></i>Ultimate convenience</li>
                        </ul>
                        <a href="#" class="button">Book Service</a>
                    </div>
                </div>
                <figure>
                    <img src="{{asset('home/assets/img/pricing-5.jpg')}}" alt="Package">
                </figure>
            </div>
            <div class="package two">
                <div class="package-text">
                    <i><img src="{{asset('home/assets/img/package-3.png')}}" alt="Package"></i>
                    <div>
                        <h4>$160.00 <span>/ Per month</span></h4>
                        <h3>Pet Hairstyles</h3>
                        <ul class="list">
                            <li><i class="fa-solid fa-check"></i>On site salon</li>
                            <li><i class="fa-solid fa-check"></i>Experienced friendly team</li>
                            <li><i class="fa-solid fa-check"></i>Grooming you can feel good about</li>
                            <li><i class="fa-solid fa-check"></i>Ultimate convenience</li>
                        </ul>
                        <a href="#" class="button">Book Service</a>
                    </div>
                </div>
                <figure>
                    <img src="{{asset('home/assets/img/pricing-6.jpg')}}" alt="Package">
                </figure>
            </div>
        </div>
    </section>
    <div class="gap no-top">
        <div class="container">
            <div class="insta-img">
                <h3><i class="fa-brands fa-instagram"></i>Follow @domain.com</h3>
                <a href="#" class="button">Follow Us</a>
            </div>
            <ul class="image-gallery">
                <li>
                    <a href="{{asset('home/assets/img/gallery-1.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-1.jpg')}}"></figure>
                    </a>
                </li>
                <li>
                    <a href="{{asset('home/assets/img/gallery-2.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-2.jpg')}}"></figure>
                    </a>
                </li>
                <li>
                    <a href="{{asset('home/assets/img/gallery-3.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-3.jpg')}}"></figure>
                    </a>
                </li>
                <li>
                    <a href="{{asset('home/assets/img/gallery-4.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-4.jpg')}}"></figure>
                    </a>
                </li>
                <li>
                    <a href="{{asset('home/assets/img/gallery-5.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-5.jpg')}}"></figure>
                    </a>
                </li>
                <li>
                    <a href="{{asset('home/assets/img/gallery-6.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-6.jpg')}}"></figure>
                    </a>
                </li>
                <li>
                    <a href="{{asset('home/assets/img/gallery-7.jpg')}}" data-fancybox="gallery">
                        <figure><img alt="girl" src="{{asset('home/assets/img/gallery-7.jpg')}}"></figure>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection
