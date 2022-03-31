@extends('admin.layout')
@section('title','Catagory List')
@section('container')
<div class="page-content upd_append">
    @if(Session::has('msg'))
    <div class="alert alert-success" role="alert">
        {{session('msg')}} </div>
    @endif
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <!-- BEGIN PAGE TITLE -->
        <div class="page-title">
            <h1>Manage Blogs <small>Catagory List</small></h1>
        </div>
        <!-- END PAGE TITLE -->

    </div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row ">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet box red">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-cogs"></i>Manage Catagory
                </div>
                <div class="tools">

                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="#portlet-config" data-toggle="modal" class="config">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                    <a href="javascript:;" class="remove">
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <a href="{{route('addcatagory')}}" class="btn green">Add Catagory  &nbsp<i class="fa fa-plus"></i> </a> 
                <button class="btn btn-danger" name="del_all"  data-route="{{route('cat_del_all')}}" id="del_all">Delete</button>
                <button class="btn purple" name="status_all" data-route="{{route('cat_status_all')}}" id="status_all">StatusAll</button>
                <div class="table-scrollable">
                    <table class="table table-hover" id="users-table">
                        <thead>
                            <tr> 
                               
                                <th>
                                    <input type="checkbox" name="checkbox" id="checkAll" value="1">
                                </th>
                                <th>
                                   Catagory
                                </th>
                                <th>
                                   Created By
                                </th>
                                <th>
                                   Status
                                </th>
                                 <th>
                                   Handle
                                </th>
                              
                            </tr>
                        </thead>
                       
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->


    </div>


    <!-- END PAGE CONTENT-->
</div>

@endsection
@section('script')
 <script src="http://code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
  
$(document).ready(function() {

    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('catagory_datable') !!}',
        columns: [
            { data: 'id', name: 'id',orderable: false,searchable: false },          
            { data: 'catagory', name: 'catagory' },
             { data: 'created_by', name: 'created_by' },
            { data: 'status', name: 'status',orderable: false,searchable: false  },
            { data: 'handle', name: 'handle',orderable: false,searchable: false },

              
        ]
           
    });
});

</script>
<script type="text/javascript">



  $(document).on('click', '#del_catagory', function(event) {
    event.preventDefault();
    var del_id=$(this).data('del_id');
    var ele=this;
    $.ajax({
      url: '{{route('del_catagory')}}',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
      type: 'POST',
      
      data: {del_id: del_id},
      success:function(data){
        if(data=='no'){
            alert('You Cant Delete This');
        }else{
        $(ele).closest('tr').fadeOut('slow');          
        }
      }
    }); 
  });


 



</script>

@endsection