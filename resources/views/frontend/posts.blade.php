@extends('layouts.frontend')



@section('content')


    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 shadow mt-5">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($news as $new)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->iteration }}" class="@if($loop->iteration == 1) {{ 'active' }} @endif">
                                </li>                                               
                            @endforeach
                        </ol>
                        <div class="carousel-inner br-6">
                            @foreach($news as $new)
                                <div class="carousel-item {{$loop->iteration == 1 ? 'active' : '' }} ">
                                    <img src="{{ asset(str_replace('public', 'storage',$new->media_link)) }}" class="d-block w-100" alt="{{ $new->media_link }}" style="opacity: 0.8;"/>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5> {{ $new->blogCategory->name }} </h5>
                                        <p> {{ $new->title }} </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>



                <div class="col-sm-4 mt-5">
                    <div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item primary-color btr-6">What we post!</li>
                            @foreach($blog_categories as $blog_category)
                                <li class="list-group-item"> {{ $blog_category->name }} </li>
                            @endforeach
                        </ul>
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <ins class="adsbygoogle"
                            style="display:block; text-align:center;"
                            data-ad-layout="in-article"
                            data-ad-format="fluid"
                            data-ad-client="ca-pub-4575696954280816"
                            data-ad-slot="7787402518"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 mt-5">
                    <div class="postlist">
                        <div class="search_posts pt-2 pb-1">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search a post ..." aria-label="Recipient's username" aria-describedby="basic-addon2" />
                                <div class="input-group-append">
                                    <span class="input-group-text primary-color" id="basic-addon2">GO</span>
                                </div>
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
                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <ins class="adsbygoogle"
                        style="display:block; text-align:center;"
                        data-ad-layout="in-article"
                        data-ad-format="fluid"
                        data-ad-client="ca-pub-4575696954280816"
                        data-ad-slot="7787402518"></ins>
                    <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>


                <div class="col-sm-4 mt-5">
                    <div class="sticky-top top-nav">
                        <h6 class="primary-color p-3 text-white btr-6">Featured Posts</h6>
                        <div class="col-sm-12 p-0">
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
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <ins class="adsbygoogle"
                            style="display:block; text-align:center;"
                            data-ad-layout="in-article"
                            data-ad-format="fluid"
                            data-ad-client="ca-pub-4575696954280816"
                            data-ad-slot="7787402518"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
