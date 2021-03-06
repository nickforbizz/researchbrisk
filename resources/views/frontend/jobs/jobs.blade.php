@extends('layouts.frontend')



@section('content')

    <section class="">
            <div class="alert text-uppercase" style="background-color: #0acc79">
                <div class="container">


                    <form action="{{ route('searchJobs') }}" class="form-inline mt-5 pt-3 justify-content-center row">

                        <div class="form-group mb-2 Xmx-sm-2 col-sm-2">
                            <b class="display-5"> Find a Job: </b>
                        </div>

                        <div class="form-group mb-2  col-sm-4">
                            <select
                                name="category"
                                class="select2 form-control w-100"
                                id=""
                                required
                            >
                                <option selected disabled>--select Category--</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->id }} - {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-2 col-sm-4">
                            <select
                                name="industry"
                                class="select2 form-control w-100"
                                id=""
                                required
                            >
                                <option selected disabled>--select Industry--</option>
                                @foreach($industries as $industry)
                                    <option value="{{ $industry->id }}"> {{ $industry->id }} - {{ $industry->name }} </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group mb-2 col-sm-2">
                            <button type="submit" class="btn btn-success mb-2">
                                SEARCH
                            </button>
                        </div>
                    </form>


                </div>
            </div>



            <div class="container">
                <div class="row mb-5 mt-2">
                    
                    @foreach($jobs as $job)
                        <div class="col-sm-12">
                            <div class="card mb-4 shadow">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $job->title }}
                                    </h5>
                                    <div>
                                       
                                        <h6 class="card-subtitle text-muted mb-2">
                                            {{ $job->company }} | {{ $job->jobIndustry->name }}
                                        </h6>
                                        <p>
                                            {{ empty($job->location) ? 'Not Set' : $job->location }} | {{ $job->working_time }} |
                                            <b>Ksh: </b> {{ (empty($job->salary) || (float) $job->salary == 0) ? 'Confidential' : $job->salary}}
                                        </p>
                                       
                                        <p> <b>Job Function: </b> {{ $job->jobCategory->name }} </p>
                                    </div>
                                    <hr />
                                    <p class="card-text">
                                        <a class="" href="{{ route('singlejob', ['id' =>  $job->uuid ]) }}"> View More Details </a>                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- .col-sm-12 -->
                    @endforeach

                        <div class="col-sm-12">
                            <div class="d-flex justify-content-center">
                                {!! $jobs->links() !!}
                            </div>                        
                        </div>
                        <!-- .col-sm-12 -->
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
    </section>


@endsection
