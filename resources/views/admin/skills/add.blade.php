@extends('layouts/master')
@section('title')
@if(!empty($result))
		Update 
	@else
		Add 
	@endif
	Skill
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
                            <a class="btn-primary" href="{{ url('admin/skills/list')}}">
                                <i class="fa fa-list"></i> About List
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
						<h2><i class="fa fa-th"></i> @if(!empty($result)) Update @else Add @endif Skill</h2>
					</div>
					<div class="body">
						<form id="form" action="{{ route('admin.skills.add') }}" method="post" enctype="multipart/form-data" autocomplete="off">
						@csrf
						
						<input type="hidden" name="id" value="@if(!empty($result)){{$result['id']}}@else{{ 0 }}@endif"  required />

                        <div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">Quote <label class="text-danger">*</label></label>
										<input  value="@if(!empty($result)){{ $result['quote'] }}@endif" type="text" required class="form-control" placeholder="Enter Quote" name="quote" >
									</div>
								</div>
							</div>

                        <div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">Skill Name </label>
										<textarea class="form-control"  name="skill_name" placeholder="Ener Skill">@if(!empty($result)){{ $result['skill_name'] }}@endif</textarea>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">SKP: <label class="text-danger">*</label></label>
										<input  value="@if(!empty($result)){{ $result['skp'] }}@endif" type="number" required class="form-control" placeholder="Enter Skill Percent Out Of 100" name="skp" min="0" max="100">
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