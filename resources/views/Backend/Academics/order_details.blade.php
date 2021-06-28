

@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Order({{ $order->id }}) Details</h2>
						<h5 class="text-white op-7 mb-2">Order title: {{ $order->title }}</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						<a href="{{ route('academicOrderPage') }}" id="add_order" class="btn btn-secondary btn-round"> <i class="fa fa-chevron-back"></i> Back </a>
					</div>
				</div>
			</div>
		</div>



        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                <form  class="form row mb-4 shadow p-3" id="order_form" enctype="multipart/formdata">
                    @csrf
                    <input type="hidden" id="form_action" value="A">
                    <input type="hidden" id="row_id" >


                    <div class="form-group col-sm-12">
                        <label for="order_title">Title:</label>
                        <input type="text" class="form-control" value="{{ $order->title }}" readonly>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="order_descr">Description:</label>
                        <textarea class="form-control" cols="5" readonly> {{ $order->description }} </textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="order_notes">Notes:</label>
                        <textarea name="notes" class="form-control" cols="5" readonly> {{ $order->notes }} </textarea>
                    </div>


                    <div class="form-group col-sm-3">
                        <label for="order_email">Email:</label>
                        <input type="email" class="form-control" value="{{ $order->email }}" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="order_format">Format:</label>
                        <input type="text" class="form-control" value="{{ $order->orderFormat->name }}" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="order_category">Category:</label>
                        <input type="text" class="form-control" value="{{ $order->orderCategory->name }}" readonly>
                    </div> <div class="form-group col-sm-3">
                        <label for="order_language">Language:</label>
                        <input type="text" class="form-control" value="{{ $order->orderLanguage->name }}" readonly>
                    </div>


                    <div class="form-group col-sm-3">
                        <label for="order_pages">Pages:</label>
                        <input type="number" class="form-control" value="{{ $order->pages }}" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="order_word_count">Word Count:</label>
                        <input type="number" class="form-control" value="{{ $order->wordcount }}" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="duedate">Due Date:</label>
                        <input type="date" class="form-control"  value="{{ $order->duedate }}" readonly>
                    </div>
                   

                    <div class="form-group col-sm-12" id="_files">
                        <h4>Files</h4> <hr>
                        @if(count($order_docs) < 1)
                            <p>No files </p>
                        @endif
                        @foreach($order_docs as $doc)
                            <div class="m-4 alert alert-info"> 
                                {{ $doc->name }}
                             <a class="btn btn-sm btn-info float-right" href="{{ route('download', ['file'=>$doc->id]) }}" target="blank"> <i class="fa fa-download"></i> Download</a>
                             </div>
                        @endforeach
                    </div>

     
                    </form>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
<script>
</script>
@endsection