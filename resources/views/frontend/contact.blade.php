@extends('layouts.frontend')



@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">
            <div class="col-sm-12 -bottom-8">
                <h5 class="primary-color btr-6 p-3 text-center"> Contact Us </h5>
            </div>
            <div class="col-sm-12">
                <div class="card p-3">
            







                <div class="container">
                    
                    <div class="row">


                        <div class="col-md-6">
                            <form>

                                <div class="form-group">
                                    <label for="names">Full Name</label>
                                    <input type="name" class="form-control" name="names" id="names" placeholder="Your Full Name...">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Your Email Address...">
                                </div>

                                <div class="form-group">
                                    <label for="service">Service</label>
                                    <select class="form-control" name="service" id="service" placeholder="Select Services...">
                                        <option>Corporate</option>
                                        <option>Wedding</option>
                                        <option>Pickup</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="msg">Message</label>
                                    <textarea class="form-control" name="msg" id="msg" aria-label="With textarea"></textarea>
                                </div>


                                <button type="submit" class="btn btn-info btn-round">Submit</button>

                            </form>
                        </div>


                        <div class="col-md-6">

                            <div class="card shadow p-4 mt-5">
                                <p class="pt-5">Address: <small class="text-muted">Venkatadri IT Park, HP Avenue, Konnappana, Electronic city, Bengaluru, Karnataka 560069</small></p>
                                <p class="pt-5">Email: <small class="text-muted">hire@luxurytaxicab.com</small></p>
                                <p class="pt-5">Contact: <small class="text-muted">+91 98765 10278 || +91 76589 14244</small></p>
                            </div>
                            
                        </div>


                        <div class="col-sm-12">
                            <!-- <p><iframe width="600" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJtcNatvRsrjsRA38LEBPt_78&key=..." allowfullscreen></iframe></p> -->
                            <div class="text-center mt-5">
                                <img class="img-fluid contact-image" alt="Responsive image" src="https://csds.qld.edu.au/sdc/resources/images/find-us-map.jpg" class="rounded" alt="...">
                            </div>
                        </div>
                
                    </div>
                </div>








                </div>
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
@endsection
