@extends('layouts/master')
@section('title')
@if(!empty($result))
		Update 
	@else
		Add 
	@endif
	Resume
@endsection
@section('content')
<style>
	input[type="date"] {
  display:block;
  position:relative;
  padding:1rem 3.5rem 1rem 0.75rem;
  
  font-size:1rem;
  font-family:monospace;
  
  border:1px solid #8292a2;
  border-radius:0.25rem;
  background:
    white
    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='22' viewBox='0 0 20 22'%3E%3Cg fill='none' fill-rule='evenodd' stroke='%23688EBB' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' transform='translate(1 1)'%3E%3Crect width='18' height='18' y='2' rx='2'/%3E%3Cpath d='M13 0L13 4M5 0L5 4M0 8L18 8'/%3E%3C/g%3E%3C/svg%3E")
    right 1rem
    center
    no-repeat;
  
  cursor:pointer;
}
input[type="date"]:focus {
  outline:none;
  border-color:#3acfff;
  box-shadow:0 0 0 0.25rem rgba(0, 120, 250, 0.1);
}

::-webkit-datetime-edit {}
::-webkit-datetime-edit-fields-wrapper {}
::-webkit-datetime-edit-month-field:hover,
::-webkit-datetime-edit-day-field:hover,
::-webkit-datetime-edit-year-field:hover {
  background:rgba(0, 120, 250, 0.1);
}
::-webkit-datetime-edit-text {
  opacity:0;
}
::-webkit-clear-button,
::-webkit-inner-spin-button {
  display:none;
}
::-webkit-calendar-picker-indicator {
  position:absolute;
  width:2.5rem;
  height:100%;
  top:0;
  right:0;
  bottom:0;
  
  opacity:0;
  cursor:pointer;
  
  color:rgba(0, 120, 250, 1);
  background:rgba(0, 120, 250, 1);
 
}

input[type="date"]:hover::-webkit-calendar-picker-indicator { opacity:0.05; }
input[type="date"]:hover::-webkit-calendar-picker-indicator:hover { opacity:0.15; }

</style>
<section class="content">
    {{-- @php
                $url = "https://university-college-list-and-rankings.p.rapidapi.com/api/top-universities/india";
                $curl = curl_init();

                $curl = curl_init();

                curl_setopt_array($curl, [
                    CURLOPT_URL => $url,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: university-college-list-and-rankings.p.rapidapi.com",
                        "X-RapidAPI-Key: 870bbd6459msh4a8f195b2ba08c1p1d41efjsna5f8502a2e04"
                    ],
                ]);

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);



                echo "<pre>";
                    print_r($response);

    @endphp --}}
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="header">
						<h2><i class="fa fa-th"></i>  Go To</h2>
					</div>
					<div class="body">
						<div class="btn-group top-head-btn">
                            <a class="btn-primary" href="{{ url('admin/resume/list')}}">
                                <i class="fa fa-list"></i> Resume List
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
						<h2><i class="fa fa-th"></i> @if(!empty($result)) Update @else Add @endif Resume</h2>
					</div>
					<div class="body">
						<form id="form" action="{{ route('admin.resume.add') }}" method="post" enctype="multipart/form-data" autocomplete="off">
						@csrf
						
						<input type="hidden" name="id" value="@if(!empty($result)){{$result['id']}}@else{{ 0 }}@endif"  required />

                        <div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputQuote">Quote <label class="text-danger">*</label></label>
										<input  value="@if(!empty($result)){{ $result['quote'] }}@endif" type="text" required class="form-control" placeholder="Enter Quote on Your Degree" name="quote" >
									</div>
								</div>
							</div>

                        <div class="row clearfix">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName"> Description</label>
										<textarea class="form-control"  name="description" placeholder="Enter Description">@if(!empty($result)){{ $result['description'] }}@endif</textarea>
									</div>
								</div>
							</div>
						</div>
						{{-- <div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<label for="inputName">Address: <label class="text-danger">*</label></label>
										<input  value="@if(!empty($result)){{ $result['address'] }}@endif" type="text" required class="form-control" placeholder="Enter Addresss" name="address" >
									</div>
								</div>
							</div>

						</div> --}}
						<div id="row clearfix" inline="true">	
						<div class="col-sm-12">
							<div class="form-group">
								<div class="form-line">
									<label for="meeting">Passing Year :
										<input type="date" value="@if(!empty($result)){{ $result['passing_year'] }}@endif" min="1957-01-01" max="2023-06-12" name="passing_year">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<label for="inputName">Degree: <label class="text-danger">*</label></label>
								<input  value="@if(!empty($result)){{ $result['degree'] }}@endif" type="text" required class="form-control" placeholder="Degree" name="degree" >
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<label for="inputName">University: <label class="text-danger">*</label></label>
								<input  value="@if(!empty($result)){{ $result['university'] }}@endif" type="text" required class="form-control" placeholder="Enter University" name="university" >
							</div>
						</div>
					</div>
					{{-- <div class="col-sm-12">
						<div class="form-group">
							<div class="form-line">
								<label for="inputName">Greeting: <label class="text-danger">*</label></label> --}}
								{{-- <input  value="@if(!empty($result)){{ $result['greeting'] }}@endif" type="text" required class="form-control" placeholder="Greeting" name="greeting" > --}}
							{{-- </div>
						</div>
					</div> --}}

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
		
		 $('.selectbox').fSelect();

		function resetFormData(){
			
			$('.previewimages').html('');
		}
	</script>
@endpush