@extends('layouts/master')
@section('title')
@if(!empty($result))
		Update 
	@else
		Add 
	@endif
	Project
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
                            <a class="btn-primary" href="{{ url('admin/project/list')}}">
                                <i class="fa fa-list"></i> Project List
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
						<h2><i class="fa fa-th"></i> @if(!empty($result)) Update @else Add @endif Project</h2>
					</div>
					<div class="body">
						<form id="form" action="{{ route('admin.project.add') }}" method="post" enctype="multipart/form-data" autocomplete="off">
						@csrf
						
						<input type="hidden" name="id" value="@if(!empty($result)){{$result['id']}}@else{{ 0 }}@endif"  required />

                        <div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">Quote: </label>
										<textarea class="form-control"  name="quote" placeholder="Quote on Skill you have">@if(!empty($result)){{ $result['quote'] }}@endif</textarea>
									</div>
								</div>
							</div>
						</div>
                        <div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">Image <label class="text-danger">*</label></label>
										<input type="file" id="uploadImage" class="form-control image"  name="image" @if(!$result) required @endif  data-type="single" data-image-preview="product" accept="image/*">
										<p style="color:red;width:100%">Size must be 1600*469 px</p>
									</div>
								</div>
								
								<div class="form-group previewimages col-md-6" id="slider">
									@if($result)
										<img src="{{ asset('uploads/projects/'.$result->image) }}" style="width: 100px;border:1px solid #222;margin-right: 13px" />
										<input type="hidden" name="old_image" value="{{ $result->image }}" />
									@endif
								</div>
							</div>
						</div>

                        <div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">Service Type: </label>
										<textarea class="form-control"  name="service_type" placeholder="Like Logo Design">@if(!empty($result)){{ $result['service_type'] }}@endif</textarea>
									</div>
								</div>
							</div>
						</div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <label for="inputName">Service: <label class="text-danger">*</label></label>
                                        <select required class="form-control" name="service_name">
                                            <!-- Add options dynamically from a data source -->
                                            @foreach($services as $service)
                                                <option value="{{ $service['service_name'] }}">{{ $service['service_name'] }}</option>
                                            @endforeach
                                        </select>
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