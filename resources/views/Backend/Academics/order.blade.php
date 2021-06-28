
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Order</h2>
						<h5 class="text-white op-7 mb-2">Order for academic papers</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						<a href="#" id="add_order" class="btn btn-secondary btn-round"> Add Order </a>
					</div>
				</div>
			</div>
		</div>






        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Available Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- // modal -->
            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="orderModalLabel">Add | Edit Order</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  class="form row mb-4 shadow p-3" id="order_form" enctype="multipart/formdata">


                            @csrf
                            <input type="hidden" id="form_action" value="A">
                            <input type="hidden" id="row_id" >


                            <div class="form-group col-sm-12">
                                <label for="order_title">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title" id="order_title">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="order_descr">Description:</label>
                                <textarea name="description" class="form-control" cols="5" id="order_descr" placeholder="Enter description"></textarea>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="order_notes">Notes:</label>
                                <textarea name="notes" class="form-control" cols="5" id="order_notes" placeholder="Enter notes"></textarea>
                            </div>


                            <div class="form-group col-sm-3">
                                <label for="order_email">Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter email" id="order_email">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="order_format">Format:</label>
                                <select name="order_format_id" id="order_format" class="form-control">
                                    <option selected disabled> -- select format --</option>
                                    @foreach($formats as $format)
                                        <option value="{{ $format->id }}"> {{ $format->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="order_category">Category:</label>
                                <select name="order_category_id" id="order_category" class="form-control">
                                    <option selected disabled> -- select Category --</option>
                                    @foreach($order_cats as $order_cat)
                                        <option value="{{ $order_cat->id }}"> {{ $order_cat->name }} </option>
                                    @endforeach
                                </select>
                            </div> <div class="form-group col-sm-3">
                                <label for="order_language">Language:</label>
                                <select name="order_language_id" id="order_language" class="form-control">
                                    <option selected disabled> -- select Language --</option>
                                    @foreach($langs as $lang)
                                        <option value="{{ $lang->id }}"> {{ $lang->name }} </option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group col-sm-3">
                                <label for="order_pages">Pages:</label>
                                <input type="number" name="pages" class="form-control" placeholder="Enter pages" id="order_pages">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="order_word_count">Word Count:</label>
                                <input type="number" name="wordcount" class="form-control" placeholder="Enter pages" id="wordcount">
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="duedate">Due Date:</label>
                                <input type="date" name="duedate" class="form-control"  id="duedate">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="order_files">Files:</label>
                                <input type="file" name="files[]" class="form-control" placeholder="Enter files" id="order_files" multiple>
                            </div>

                            <div class="form-group col-sm-12" id="del_files">

                            </div>


                            <div class="col-sm-12">
                            <hr>
                                <button type="submit" class="btn btn-sm btn-primary float-right">Submit</button>
                            </div>       
                        </form>
                        <div class="row">
                            <div class="form-group col-sm-12" id="del_files"></div>
                        </div>
                    </div>
                   
                    </div>
                </div>
            </div>
        </div>
		
		
	</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $("#del_files").hide();
        $('#basic-datatables').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            pageLength: 5,
            // scrollX: true,
            "order": [[ 0, "desc" ]],
            ajax: '{{ route('academicOrderList') }}',
            columns: [
                {data: 'title'},
                {data: 'description'},
                {data: 'Actions', orderable:false,serachable:false,sClass:'text-center'},
            ]
        });

        // modal
        $("#add_order").click(()=>{
            $("#order_form")[0].reset();
            $("#form_action").val('A');
            $("#orderModal").modal();
        })

        $("#order_form").submit(function(e) {
            e.preventDefault();

            let form_action = $("#form_action").val();
            let row_id = $("#row_id").val();
            let action_url = '';
            (form_action == 'A') ? action_url = "{{ route('academicCreateOrder')}}" : action_url = "academic_update_order/"+row_id;
            let payload = new FormData(this);
            $.ajax({
                url: action_url,
                data: payload,
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                success: (payload) => {
                    console.log(payload);
                    $("#orderModal").modal('hide');
                    $('#basic-datatables').DataTable().ajax.reload();
                    let type_msg = 'info'
                    (payload.code != 1) ? type_msg = 'danger' : type_msg = 'success';

                    $.notify({
                        icon: 'flaticon-alarm-1',
                        message: payload.msg,
                    },{
                        type: type_msg,
                        time: 1000,
                    });
                },
                error: (err) => { console.error(err)}
            })
        })


        // wordcount
        $("#order_pages").keyup(function (e) {
            let pages = $(this).val();
            let wordcount = pages * 275;
            $("#wordcount").val(wordcount)
        })
    }); 

    // edit data
    function editOrder(id) {
        $("#order_form")[0].reset();
        $("#del_files").html("").hide();
        $("#row_id").val(id);
        $("#form_action").val('E')
        
        //data to edit
        $.ajax({
            url: 'academic_edit_order/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload);
                if(payload.data){
                    $("#order_title").val(payload.data.title)
                    $("#order_descr").val(payload.data.description)
                    $("#order_notes").val(payload.data.notes)
                    $("#order_email").val(payload.data.email)
                    $("#order_format").val(payload.data.order_format_id)
                    $("#order_category").val(payload.data.order_category_id)
                    $("#order_language").val(payload.data.order_language_id)
                    $("#order_pages").val(payload.data.pages)
                    $("#wordcount").val(payload.data.wordcount)
                    $("#duedate").val(payload.data.duedate)

                    // files
                    if (payload.docs.length > 0) {
                        $("#del_files").html(`<h3> Available files </h3>`).show();
                        payload.docs.map(doc => {
                            $("#del_files").append(`
                                <div>
                                    
                                    <a href="#" onclick="removeFile('${doc.id}')" class="btn btn-sm btn-danger float-right" data-link="${doc.media_link}"> Remove </a>
                                    <div> ${doc.name} </div>
                                    <hr>
                                </div>
                            `);
                        })
                        // func added
                       
                    }
                }
                $("#orderModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }



    function removeFile(id) {
        let confirmed = confirm("Are you sure you want to delete this file");
        if (confirmed) {
            let payload = {_token: "{{ csrf_token() }}"}
            $.ajax({
                url: 'academic_del_order_doc/'+id,
                method: 'delete',
                data: payload,
                success: (payload) => {
                    console.log(payload);
                    location.reload();
                },
                error: (err) => console.error(err)
            });
        }
    }
</script>
@endsection
			
		
		
	