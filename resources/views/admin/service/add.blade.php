@extends('layouts/master')
@section('title')
@if(!empty($result))
		Update 
	@else
		Add 
	@endif
	Service
@endsection
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
                            <a class="btn-primary" href="{{ url('admin/service/list')}}">
                                <i class="fa fa-list"></i> Service List
							</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="header">
						<h2><i class="fa fa-th"></i> @if(!empty($result)) Update @else Add @endif Service</h2>
					</div>
					<div class="body">
						<form id="form" action="{{ route('admin.service.add') }}" method="post" enctype="multipart/form-data" autocomplete="off">
						@csrf
						
						<input type="hidden" name="id" value="@if(!empty($result)){{$result['id']}}@else{{ 0 }}@endif"  required />

                        <div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName"> Description</label>
										<textarea class="form-control"  name="description" placeholder="Ener Description">@if(!empty($result)){{ $result['description'] }}@endif</textarea>
									</div>
								</div>
							</div>
						</div>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<label for="inputName">Service Name: <label class="text-danger">*</label></label>
								<input  value="@if(!empty($result)){{ $result['service'] }}@endif" type="text" required class="form-control" placeholder="Enter Service" name="service" >
							</div>
						</div>
					</div>

						</div>
						<div class="col-lg-12 p-t-20 text-center">
							@if(empty($result)) 
								<button type="reset" class="btn btn-danger waves-effect">Reset</button>
							@endif
							<button style="background:#353c48;" type="submit" class="btn btn-primary waves-effect m-r-15" >@if(!empty($result)) Update @else Submit @endif</button> 
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@push('custom_js')

<script>
    		function resetFormData(){
			
			$('.previewimages').html('');
		}
</script>
@endpush