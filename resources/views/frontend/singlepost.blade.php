@extends('layouts.frontend')



@section('content')

    <div class="p-2 mt-4">
        <div class="row">
            <div class="col-sm-8">
                <article>
                    <div class="modal fade" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header primary-color">
                                    <h5 class="modal-title">Add Comment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="form row" action="{{ route('postComments') }}" method="post">
                                        <div class="form-group col-sm-6">
                                            @csrf
                                            <input type="hidden" name="uuid" value="{{ $blog->uuid }}">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name ..." required>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email ..." required>
                                        </div>

                                        <div class="form-group col-sm-12">
                                            <label for="msg">Message</label>
                                            <textarea class="form-control" name="comment" id="msg" rows="3" placeholder="Type you message ..." required></textarea>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <hr>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer primary-color">
                                 <i class="float-right">At -Research Brisk we offer the best. </i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container shadow-sm">

                        <div class="nav_article">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item "> 
                                        <a class="text-uppercase letter-span" href="/"> {{ $blog->blogCategory->name }} </a> 
                                    </li>
                                    <li class="breadcrumb-item nav_article-breadcrumb "> 
                                        <time datetime="{{ $blog->created_at }}"> {{ $blog->created_at }} </time> 
                                    </li>
                                    <li class="breadcrumb-item nav_article-breadcrumb active" aria-current="page">by: 
                                        <a class="text-uppercase letter-span" href="/"> {{ $blog->user->name }} </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="text-justify text-capitalize mt-2 lh-2"> {{ $blog->title }} </h4>
                                <hr>
                            </div>
                            <div class="col-sm-12">
                                <figure class="figure w-100"><img
                                        src="{{ asset(str_replace('public', 'storage',$blog->media_link)) }}"
                                        class="figure-img img-fluid rounded w-100"
                                        alt="{{ $blog->title }}">
                                    <figcaption class="figure-caption text-lowercase">{{ $blog->description }}</figcaption>
                                </figure>
                            </div>
                            <div class="col-sm-12">
                               {!! $blog->body !!}
                            </div>
                            <div class="col-sm-12">
                                <div class="bootstrap snippets bootdey card mt-5">
                                    <div class="card-img-top">
                                        <h3 class="primary-color p-3 text-white btr-6">Comments
                                        <button class="btn float-right" style="background:#9aff5b; border-radius:5rem" data-toggle="modal" data-target="#commentsModal">
                                            <i class="fa fa-plus"></i> 
                                            Add Comment
                                        </button>

                                        </h3>
                                        <hr>
                                    </div>
                                    <div class="row p-4">
                                        <div class="col-md-12">
                                            <div id="accordion">
                                                @if($blog->blogsComments->count() < 1)
                                                <p> Be the first to comment on this post!</p>
                                                @endif
                                                @foreach($blog->blogsComments as $blog_comment)
                                                    <div class="card mb-2" style="border-radius: 2rem; overflow: hidden;">
                                                        <div class="card-body" >
                                                            <blockquote class="blockquote mb-0">
                                                                <p style="font-size: 1rem"> {{ $blog_comment->comment }} </p>
                                                                <footer class="blockquote-footer">
                                                                    @if($blog_comment->parent_id == null)
                                                                        <button class="btn btn-sm btn-info float-right collapsed" data-toggle="collapse" data-target="#CollapseExample{{ $blog_comment->uuid }}" aria-expanded="false" aria-controls="CollapseExample{{ $blog_comment->uuid }}"  style="border-radius:5rem"> Reply </button>
                                                                    @endif
                                                                    By; 
                                                                    <cite title="Source Title">{{ $blog_comment->name }} | {{ $blog_comment->created_at }}</cite>
                                                                </footer>

                                                                <div class="reply_comment mt-3 collapse" id="CollapseExample{{ $blog_comment->uuid }}" data-parent="#accordion">
                                                                    <form class="form row" action="{{ route('postComments') }}" method="post">
                                                                        <div class="form-group col-sm-6">
                                                                            @csrf
                                                                            <input type="hidden" name="uuid" value="{{ $blog->uuid }}">
                                                                            <input type="hidden" name="parent_id" value="{{ $blog_comment->id }}">
                                                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name ..." required>
                                                                        </div>

                                                                        <div class="form-group col-sm-6">
                                                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email ..." required>
                                                                        </div>

                                                                        <div class="form-group col-sm-12">
                                                                            <textarea class="form-control" name="comment" id="msg" rows="3" placeholder="Type you message ..." required></textarea>
                                                                        </div>
                                                                        <div class="form-group col-sm-12">
                                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </blockquote>
                                                        </div>
                                                    </div>

                                                    <div>
                                                    @foreach($blog_comment->replies as $reply)
                                                    <div class="card mb-2" style="margin-left:40px;border-radius: 2rem; overflow: hidden;">
                                                        <div class="card-body" >
                                                            <blockquote class="blockquote mb-0">
                                                                <p style="font-size: 1rem"> {{ $reply->comment }} </p>
                                                                <footer class="blockquote-footer">
                                                                    By; 
                                                                    <cite title="Source Title">{{ $reply->name }} | {{ $reply->created_at }} </cite>
                                                                </footer>
                                                                </blockquote>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- .col-md-12 -->
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
                </article>
            </div>




            <div class="col-sm-4 ">
                <div class="sticky-top top-nav">
                    <h6 class="p-3 text-white primary-color -bottom-8 btr-6">Tags</h6>
                    <div class="col-sm-12 p-0 mb-5">
                        @if(count($blog->blogTagsPivots) < 1)
                            <p>No Tags at the moment</p>
                        @else
                            @foreach($blog->blogTagsPivots as $tag)
                            <a href="" class="tag"> {{ $tag->tag_title }} </a>
                            @endforeach
                        @endif
                    </div>

                    <h6 class="p-3 text-white primary-color -bottom-8 btr-6">Featured Posts</h6>
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
                    <!-- .col-sm-12 p-0 -->
                    
                </div>
                <!-- .sticky-top top-nav -->
            </div>
            <!-- .col-sm-4 -->
        </div>
        <div class="row mt-5 p-4">
            <div class="col-sm-12">
                <h6 class="primary-color p-3 text-white btr-6"> You may Also Like </h6>
            </div>

            @foreach($simiral_blogs as $simiral_blog)
            <div class="col-sm-6 col-md-3 mb-5">
                <div class="card">
                    <img src="{{ asset(str_replace('public', 'storage',$simiral_blog->media_link)) }}" class="card-img-top" alt="{{ $simiral_blog->title }}" />
                    <div class="card-body">
                    <a class="card-title text-dark" href="{{ route('post', ['id'=>$simiral_blog->uuid, 'slug'=>$simiral_blog->slug]) }}" style="font-size: small; font-weight: bold;"> 
                        {{ $simiral_blog->description }} 
                    </a>
                    </div>
                </div>
            </div>
            <!-- .col-sm-6 col-md-3 mb-5 -->
            @endforeach


            
        </div>
        <!-- .row mt-5 p-4 -->
    </div>


@endsection
