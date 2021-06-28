@extends('layouts.frontend')
@section('content')
                    <div class="row">
                        <div class="col-sm-12 primary-color">
                            <div class="container">


                                <div class="row mt-2 mb-2">
                                    <div class="col-sm-7 p-5">
                                        <h3> Blogger and Academic Writer </h3>
                                        <hr>
                                        <p class="text-justify pt-2">This is A Centre for All Experts. We Offer the best
                                            Academic Writing Solutions at the Cheapest Prices and Quality Niched
                                            Blogging. Get all Latest Jobs Updates and Connect Directly with Your
                                            employer through our Job Application Solutions.</p>
                                        <div>
                                            <a class="btn btn-primary" href="{{ route('orderassignment') }}">Order an Assignment</a>
                                        </div>
                                    </div>


                                    <div class="col-sm-5 " style="margin-top: 5rem">
                                        <div id="carouselExampleIndicators" class="carousel slide pointer-event"
                                            data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                @foreach($news as $new)
                                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration }}" class="@if($loop->iteration == 1) {{ 'active' }} @endif">
                                                </li>                                               
                                                @endforeach
                                            </ol>
                                            <div class="carousel-inner br-6">
                                                @foreach($news as $new)
                                                    <div class="carousel-item {{$loop->iteration == 1 ? 'active' : '' }}">
                                                        <img src="{{ asset(str_replace('public', 'storage',$new->media_link)) }}" class="d-block w-100" alt="{{ $new->media_link }}" style="opacity: 0.8;"/>
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <h5> {{ $new->blogCategory->name }} </h5>
                                                            <p> {{ $new->title }} </p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span><span
                                                    class="sr-only">Previous</span></a><a class="carousel-control-next"
                                                href="#carouselExampleIndicators" role="button" data-slide="next"><span
                                                    class="carousel-control-next-icon" aria-hidden="true"></span><span
                                                    class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="row">
                        <div class="col-sm-6 col-md-2 mt-5 mb-5 d-none d-md-block">
                            <div class="sticky-top top-nav">
                                <div class="list-group list-group-flush ml-1">
                                    <div class="list-group-item  primary-color btr-6">More on Academics</div>
                                    <a class="list-group-item list-group-item-action" href="/">Home</a>
                                    <a class="list-group-item list-group-item-action" href="/academicbio">Academic Bio</a>
                                    <a class="list-group-item list-group-item-action" href="/academicpayrates">Pay Rates</a>
                                    <a class="list-group-item list-group-item-action" href="/academicservices">Services</a>
                                    <a class="list-group-item list-group-item-action" href="/academicworksamples">Work Samples</a>
                                    <a class="list-group-item list-group-item-action" href="/academictestimonials">Testimonials</a>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-7 col-lg-7 Xorder-md-3 mt-5">
                            <div class="postlist">
                                <div class="search_posts pt-2 pb-1">
                                    <div class="input-group mb-3"><input type="text" class="form-control"
                                            placeholder="Search a post ..." aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append"><span class="input-group-text primary-color"
                                                id="basic-addon2">GO</span></div>
                                    </div>
                                </div>




                                



                                @foreach($blogs as $blog)
                                    
                                <div class="card mb-3">
                                    <div class="row no-gutters" style="overflow: hidden; position: relative;">
                                        <div class="col-sm-12 col-md-4 cover_img" style="overflow: hidden; position: relative; background: url('{{ asset(str_replace('public', 'storage',$blog->media_link)) }}');">
                                        </div>
                                        <div class="col-sm-12 col-md-8">
                                            <div class="card-body">
                                                <h6 class="card-title"> {{ $blog->title }} </h6>

                                                <p class="card-text" style="overflow: hidden; max-height: 4rem;">{{ $blog->description }}</p>
                                                
                                                <hr>
                                                <div>
                                                    <a class="btn btn-sm btn-info float-right primary-color" href="{{ route('post', ['id'=>$blog->uuid, 'slug'=>$blog->slug]) }}">
                                                        view 
                                                    </a>
                                                    <p class="card-text">
                                                        <small class="text-muted"> <time datetime="{{ $blog->created_at }}"> {{ $blog->created_at }} </time></small>
                                                        | <i class="text-muted">By {{ $blog->user->name }}</i>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- .card .mb-3 -->
                                @endforeach

                            </div>
                        </div>


                        <div class="col-sm-12 col-md-3 col-lg-3 mt-5">
                            <div class="sticky-top top-nav">
                                <div class="row">
                                    <div class="col-sm-12 primary-color btr-6 mt-2">
                                        <h6 class="primary-color p-3 text-white btr-6">Breaking News</h6>
                                    </div>


                                    <div class="col-sm-12 p-0 mb-3">

                                        @foreach($blogs as $blog)
                                            <div class="card mb-1">
                                                <div class="row no-gutters" style="overflow: hidden; position: relative;">
                                                    <div class="col-sm-12 col-md-4 cover_img" style="overflow: hidden; position: relative;background-color: #f1f1f1 !important; background: url('{{ asset(str_replace('public', 'storage',$blog->media_link)) }}');">
                                                    </div>
                                                    <div class="col-sm-12 col-md-8">
                                                        <div class="card-body">
                                                            <a class="card-title text-dark" href="{{ route('post', ['id'=>$blog->uuid, 'slug'=>$blog->slug]) }}" style="font-size: small; font-weight: bold;"> 
                                                                {{ $blog->title }}
                                                            </a>
                                                            <p class="card-text" style="overflow: hidden; height: 2rem; font-size: small;">By; {{ $blog->user->name }} </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                       
                                    </div>


                                    <div class="col-sm-12 p-0 mt-2 mb-3">
                                        <div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item primary-color btr-6">What we post!</li>
                                                <li class="list-group-item">Academic Bio</li>
                                                <li class="list-group-item">Pay Rates</li>
                                                <li class="list-group-item">Services</li>
                                                <li class="list-group-item">Work Samples</li>
                                                <li class="list-group-item">Testimonials</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <section class="py-5">
                                <div class="container text-center">
                                    <h2>What's So Great About Research Brisk</h2>
                                    <hr>
                                    <div class="row">
                                        <div class="carousel slide my-4 pointer-event" id="carousel-testimonials-02"
                                            data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <div class="row">
                                                        <div class="col-md-4 mt-5">
                                                            <p class="mb-4">It's a really cool network. Like, we had a
                                                                fight with Richard at one point, and I think they
                                                                deleted some of my data, but then they brought it back.
                                                                Just bro's being bro's. Respected!</p><img
                                                                class="mx-auto rounded-circle"
                                                                src="{{ asset('storage/img/chicken_little_funny-wallpaper-1920x1080.jpg') }}" alt="" height="60"
                                                                width="60">
                                                            <p class="mt-4 mb-0">Colin</p>
                                                            <p class="text-muted">CEO at K-Hole</p>
                                                        </div>
                                                        <div class="col-md-4 mt-5">
                                                            <p class="mb-4">This is such a great product that I feel
                                                                aroused every time I use it. I didn't know the boys
                                                                would be able to build, but god damn it, they did it.
                                                                Kickass!</p><img class="mx-auto rounded-circle"
                                                                src="{{ asset('storage/img/chicken_little_funny-wallpaper-1920x1080.jpg') }}" alt="" height="60"
                                                                width="60">
                                                            <p class="mt-4 mb-0">Russ Hanneman</p>
                                                            <p class="text-muted">Investor, Angel, Great Guy</p>
                                                        </div>
                                                        <div class="col-md-4 mt-5">
                                                            <p class="mb-4">Even though I have been dismantled, I live
                                                                on as an artificial intelligence on the PiperNet. I
                                                                really like it here. Still waiting for Jared to
                                                                Piper-chat with me sometime.</p><img
                                                                class="mx-auto rounded-circle"
                                                                src="{{ asset('storage/img/chicken_little_funny-wallpaper-1920x1080.jpg') }}" alt="" height="60"
                                                                width="60">
                                                            <p class="mt-4 mb-0">Fiona</p>
                                                            <p class="text-muted">Artificial Intelligence</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="row">
                                                        <div class="col-md-4 mt-5">
                                                            <p class="mb-4">It's a really cool network. Like, we had a
                                                                fight with Richard at one point, and I think they
                                                                deleted some of my data, but then they brought it back.
                                                                Just bro's being bro's. Respected!</p><img
                                                                class="mx-auto rounded-circle"
                                                                src="{{ asset('storage/img/chicken_little_funny-wallpaper-1920x1080.jpg') }}"
                                                                alt="" height="60" width="60">
                                                            <p class="mt-4 mb-0">Colin</p>
                                                            <p class="text-muted">CEO at K-Hole</p>
                                                        </div>
                                                        <div class="col-md-4 mt-5">
                                                            <p class="mb-4">This is such a great product that I feel
                                                                aroused every time I use it. I didn't know the boys
                                                                would be able to build, but god damn it, they did it.
                                                                Kickass!</p><img class="mx-auto rounded-circle"
                                                                src="{{ asset('storage/img/chicken_little_funny-wallpaper-1920x1080.jpg') }}"
                                                                alt="" height="60" width="60">
                                                            <p class="mt-4 mb-0">Russ Hanneman</p>
                                                            <p class="text-muted">Investor, Angel, Great Guy</p>
                                                        </div>
                                                        <div class="col-md-4 mt-5">
                                                            <p class="mb-4">Even though I have been dismantled, I live
                                                                on as an artificial intelligence on the PiperNet. I
                                                                really like it here. Still waiting for Jared to
                                                                Piper-chat with me sometime.</p><img
                                                                class="mx-auto rounded-circle"
                                                                src="{{ asset('storage/img/chicken_little_funny-wallpaper-1920x1080.jpg') }}"
                                                                alt="" height="60" width="60">
                                                            <p class="mt-4 mb-0">Fiona</p>
                                                            <p class="text-muted">Artificial Intelligence</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mx-auto"><a
                                                class="carousel-control-prev position-relative d-inline mr-2"
                                                href="#carousel-testimonials-02" role="button" data-slide="prev"><img
                                                    src="placeholder/icons/chevron-left.svg" aria-hidden="true"
                                                    alt=""><span class="sr-only">Previous</span></a><a
                                                class="carousel-control-next position-relative d-inline"
                                                href="#carousel-testimonials-02" role="button" data-slide="next"><img
                                                    src="placeholder/icons/chevron-right.svg" aria-hidden="true"
                                                    alt=""><span class="sr-only">Next</span></a></div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="float-right fixed-bottom">
            <a href="https://wa.me/254112252848" class="whatsapp_float"
                target="_blank" rel="noopener noreferrer">
                <i class="fa fa-whatsapp whatsapp-icon"></i>
            </a>
        </div>

@endsection
