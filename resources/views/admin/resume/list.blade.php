@extends('layouts/master')

@section('title',__('Resume List'))

@section('content')

<section class="content">
    <div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="header">
						<h2><i class="fa fa-th"></i>  Go To</h2>
					</div>
					<div class="body">
						<div class="btn-group top-head-btn">
                            <a class="btn-primary" href="{{ url('admin/resume/add') }}">
                                <i class="fa fa-plus"></i> Add About 
							</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
					<div class="header">
						<h2><i class="fa fa-th"></i> Resume List</h2>
					</div>
                    <div class="body">
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-hover js-basic-example contact_list dataTable"
                                            id="DataTables_Table_0" role="grid"
                                            aria-describedby="DataTables_Table_0_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="center sorting sorting_asc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 48.4167px;" aria-sort="ascending"
                                                        aria-label="#: activate to sort column descending"># ID</th>
                                                        <th class="center sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 126.333px;"
                                                        aria-label=" Name : activate to sort column ascending">
                                                        Quote
                                                    </th>
                                                        <th class="center sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 126.333px;"
                                                        aria-label=" Name : activate to sort column ascending">
                                                        Passing Year
                                                    </th> 
                                                    <th class="center sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 126.333px;"
                                                        aria-label=" Name : activate to sort column ascending"> Degree
                                                    </th> 
                                                    <th class="center sorting" tabindex="0"
                                                    aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                    style="width: 126.333px;"
                                                    aria-label=" Name : activate to sort column ascending"> University Name
                                                </th>
                                                <th class="center sorting" tabindex="0"
                                                aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                style="width: 126.333px;"
                                                aria-label=" Name : activate to sort column ascending">  CV Link
                                            </th>
                                                    <th class="center sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 193.017px;"
                                                        aria-label=" Email : activate to sort column ascending"> Status
                                                    </th>
                                                    <th class="center sorting" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 85px;"
                                                        aria-label=" Action : activate to sort column ascending"> Action
                                                    </th> 
                                                </tr>
                                            </thead>
                                            <tbody class="row_position">
												@if(!empty($result))
													@foreach($result as $key=>$value)
														<tr class="gradeX odd"  id="{{ $value->id }}">
															<td class="center">{{ $key+1}}</td>
                                                            <td class="center">{{ ucfirst($value['quote']) }}</td>
                                                            <td class="center">{{ ucfirst($value['passing_year']) }}</td>
                                                            <td class="center">{{ ucfirst($value['degree']) }}</td>
                                                            <td class="center">{{ ucfirst($value['university']) }}</td>
                                                            <td>{{ \App\Helpers\CommonHelper::getCv($value['about_id']) }}</td>

															<td class="center">
                                                                <div class="switch mt-3">
                                                                    <label>
                                                                        <input type="checkbox" class="-change" data-id="{{ $value['id'] }}"@if($value['status']=='Active'){{ 'checked' }} @endif>
                                                                        <span class="lever switch-col-red layout-switch"></span>
                                                                    </label>
                                                                </div>
                                                            </td>
                                                            <td class="center">
                                                            
                                                                <a href="{{ url('admin/resume/update/'.$value['id'] )}}" title="Edit Resume" class="btn btn-tbl-edit">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <a title="Delete About" onclick="return confirm('Are you sure? You want to delete this Resume.')" href="{{ url('admin/resume/delete/'.$value['id'] )}}" class="btn btn-tbl-delete">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
														</tr>
													@endforeach
												@endif
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th class="center" rowspan="1" colspan="1">#</th>
                                                    <th class="center" rowspan="1" colspan="1"> Quote </th>	
                                                    <th class="center" rowspan="1" colspan="1"> Passing Year </th>	
                                                    <th class="center" rowspan="1" colspan="1"> Degree </th>	
                                                    <th class="center" rowspan="1" colspan="1"> University </th>	
                                                    <th class="center" rowspan="1" colspan="1"> CV Link</th>	
													<th class="center" rowspan="1" colspan="1"> Status </th>
                                                    <th class="center" rowspan="1" colspan="1"> Action </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
   
@push('custom_js')
    <script>
	
        $('.-change').change(function() {

            var status = $(this).prop('checked') == true ? 'Active' : 'De-Active';
            var id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.resume.changestatus') }}",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
                data: {
                    'status': status, 
                    'id': id
                },
                beforeSend:function(){
                    $('#preloader').css('display','block');
                },
                error:function(xhr,textStatus){
					
                    if(xhr && xhr.responseJSON.message){
						sweetAlertMsg('error', xhr.status + ': ' + xhr.responseJSON.message);
					}else{
						sweetAlertMsg('error', xhr.status + ': ' + xhr.statusText);
					}
                    $('#preloader').css('display','none');
                },
                success: function(data){
					$('#preloader').css('display','none');
                    sweetAlertMsg('success',data.message);
                }
            });
		});
		
    </script>  
  

@endpush