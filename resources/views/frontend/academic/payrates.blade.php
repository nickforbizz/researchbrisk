@extends('layouts.frontend')



@section('content')
    <div class="container">
        <div class="row mt-5 mb-5">

            <div class="col-sm-12 -bottom-8 mt-5">
                <h5 class="primary-color btr-6 p-3 text-center">Academic PayRates</h5>
            </div>

            <div class="col-sm-12">

                <div class="row mt-5 mb-5">

                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="card shadow" >
                        <img class="card-img-top" src="{{ asset('/backend/img/examples/product1.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Basic</h5>
                            <p class="card-text">
                                    <ul class="list-group">                                        
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    </ul>
                                </p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary requestService" data-req="1" id="basic">Make a Request</a>
                            </div>
                        </div>
                        </div>
                    </div>
    
    
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="card shadow" >
                        <img class="card-img-top" src="{{ asset('/backend/img/examples/product1.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-center">Silver</h5>
                            <p class="card-text">
                                    <ul class="list-group">                                        
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    </ul>
                                </p>
                            <div class="text-center">
                                <a href="#" class="btn btn-primary requestService" data-req="2"  id="silver">Make a Request</a>
                            </div>
                        </div>
                        </div>
                    </div>
    
    
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="card shadow" >
                            <img class="card-img-top" src="{{ asset('/backend/img/examples/product1.jpg') }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center">Gold</h5>
                                <p class="card-text">
                                    <ul class="list-group">                                        
                                        <li class="list-group-item">Dapibus ac facilisis in</li>
                                        <li class="list-group-item">Morbi leo risus</li>
                                        <li class="list-group-item">Porta ac consectetur ac</li>
                                        <li class="list-group-item">Vestibulum at eros</li>
                                    </ul>
                                </p>
                                <div class="text-center">
                                    <a href="#" class="btn btn-primary requestService" data-req="3"  id="gold">Make a Request</a>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>




                <!-- Modal -->
                <div class="modal fade" id="payratesModal" tabindex="-1" role="dialog" aria-labelledby="payratesModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="payratesModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                        <form action="#" class="form">
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select name="category" id="category" class="form-control">
                                            <option selected disabled>Choose option</option>
                                            <option value="1">Basic</option>
                                            <option value="2">Silver</option>
                                            <option value="3">Gold</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" class="form-control" placeholder="Enter Subject">
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" class="form-control" id="message" cols="10" placeholder="Enter message"></textarea>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>

                        </form>


                    </div>
                </div>
                </div>



            </div>

        </div>
    </div>
@endsection

@section("scripts")
<script>
    $(".requestService").click(function (e) {

        let title = $(this).attr('id').toUpperCase();
        let category = $(this).attr('data-req');

        $("#category").val(category).change();
        $("#payratesModalLabel").text(title+" Request")
        $("#payratesModal").modal();
    })
</script>
@endsection
