	  @extends('layouts.app')
	 @section('content')
	 
	 
	 <section id="home-section" class="hero">
		 <div class="home-slider  owl-carousel">
					@if(!@empty($abouts))
					   @foreach($abouts as $key => $value)
				<div class="slider-item ">
					<div class="overlay"></div>
					<div class="container">
					<div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
						<div class="one-third js-fullheight order-md-last img" style="background-image:url(images/bg_1.png);">
							<div class="overlay"></div>
						</div>
						<div class="one-forth d-flex  align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
							<div class="text">
								<span class="subheading">{{$value->greeting}}</span>
								<h1 class="mb-4 mt-3">I'm <span>{{\App\Helpers\commonHelper::extractFirstAndMiddleName($value->name)}}</span></h1>
								<h2 class="mb-4">{{$value->profile}}</h2>
								<p><a href="#" class="btn btn-primary py-3 px-4">Hire me</a> <a href="#" class="btn btn-white btn-outline-white py-3 px-4">My works</a></p>
							</div>
						</div>
						</div>
					</div>
				</div>
				</div>
			@endforeach
		@endif
    </section>

    <section class="ftco-about img ftco-section ftco-no-pb" id="about-section">
    	<div class="container">
			<div class="row d-flex">
				@if(!@empty($abouts))
	   @foreach($abouts as $key => $value)
    			<div class="col-md-6 col-lg-5 d-flex">
    				<div class="img-about img d-flex align-items-stretch">
    					<div class="overlay"></div>
	    				<div class="img d-flex align-self-stretch align-items-center" style="background-image:url(images/bg_1.png);">
	    				</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-7 pl-lg-5 pb-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<h1 class="big">About</h1>
		            <h2 class="mb-4">About Me</h2>
		            <p>{{$value->quote}}</p>
		            <ul class="about-info mt-4 px-md-0 px-2">
		            	<li class="d-flex"><span>Name:</span> <span>{{$value->name}}</span></li>
		            	<li class="d-flex"><span>Date of birth:</span> <span>{{$value->dob}}</span></li>
		            	<li class="d-flex"><span>Address:</span> <span>{{$value->address}}</span></li>
		            	<li class="d-flex"><span>Zip code:</span> <span>{{$value->zip_code}}</span></li>
		            	<li class="d-flex"><span>Email:</span> <span>{{$value->email}}</span></li>
		            	<li class="d-flex"><span>Phone: </span> <span>{{$value->alt_mobile}}</span></li>
		            </ul>
		          </div>
		        </div>
	          <div class="counter-wrap ftco-animate d-flex mt-md-3">
              <div class="text">
              	<p class="mb-4">
	                <span class="number" data-number="120">0</span>
	                <span>Project complete</span>
                </p>
                <p><a href="#" class="btn btn-primary py-3 px-3">Download CV</a></p>
              </div>
	          </div>
	        </div>
			@endforeach
			@endif
        </div>
    	</div>
    </section>

	
	<section class="ftco-section ftco-no-pb" id="resume-section">
    	<div class="container">
    		<div class="row justify-content-center pb-5">
          <div class="col-md-10 heading-section text-center ftco-animate">
          	<h1 class="big big-2">Resume</h1>
            <h2 class="mb-4">Resume</h2>
			{{-- @if(!empty($resume))
			<p>{{ $resume->first()->quote }}</p>
		@endif --}}
		@if(!empty($resume))
    <p>{{ $resume->random()->quote }}</p>
@endif
          </div>
        </div>
    		<div class="row">
				@if(!empty($resume))
@foreach($resume as $key => $value)
    			<div class="col-md-6">
    				<div class="resume-wrap ftco-animate">
    					<span class="date">{{$value->passing_year}}</span>
    					<h2>{{$value->degree}}</h2>
    					<span class="position">{{$value->university}}</span>
    					<p class="mt-4">{{$value->description}}</p>
    				</div>
    			</div>
				@endforeach
				@endif
    		</div>

    		<div class="row justify-content-center mt-5">
    			<div class="col-md-6 text-center ftco-animate">
    				<p><a href="#" class="btn btn-primary py-4 px-5">Download CV</a></p>
    			</div>
    		</div>
    	</div>
    </section>

	
    <section class="ftco-section" id="services-section">
		<div class="container">
			<div class="row justify-content-center py-5 mt-5">
				<div class="col-md-12 heading-section text-center ftco-animate">
					<h1 class="big big-2">Services</h1>
					<h2 class="mb-4">Services</h2>
					@if(!empty($resume))
					<p>{{ $resume->random()->quote }}</p>
				@endif				</div>
			</div>
    		<div class="row">
				@if(!empty($service))
					@foreach($service as $key => $value)
					<div class="col-md-4 text-center d-flex ftco-animate">
						<a href="#" class="services-1">
							<span class="icon">
								<i class="flaticon-analysis"></i>
							</span>
							<div class="desc">
								<h3 class="mb-5">{{$value->service_name}}</h3>
							</div>
						</a>
					</div>

					@endforeach
					@endif
				</div>
    	</div>
    </section>

	
	<section class="ftco-section" id="skills-section">
		<div class="container">
			<div class="row justify-content-center pb-5">
	  <div class="col-md-12 heading-section text-center ftco-animate">
		  <h1 class="big big-2">Skills</h1>
		<h2 class="mb-4">My Skills</h2>
		@if(!empty($skill))
		<p>{{ $skill->random()->quote }}</p>
	@endif	</div>
	</div>
			<div class="row">
@if(!empty($skill))
	@foreach($skill as $key => $value)
				<div class="col-md-6 animate-box">
					<div class="progress-wrap ftco-animate">
						<h3>{{$value->skill_name}}</h3>
						<div class="progress">
							 <div class="progress-bar color-1" role="progressbar" aria-valuenow="{{$value->skp}}"
							  aria-valuemin="0" aria-valuemax="100" style="width:{{$value->skp}}%">
							<span>{{$value->skp}}%</span>
							  </div>
						</div>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</section>


		
		<section class="ftco-section ftco-project" id="projects-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
					<div class="col-md-12 heading-section text-center ftco-animate">
						<h1 class="big big-2">Projects</h1>
						<h2 class="mb-4">Our Projects</h2>
						@if(!empty($project))
						<p>{{ $project->random()->quote }}</p>
					@endif					</div>
				</div>
				<div class="row">
				@if(!empty($project))
					@foreach($project as $key => $value)
    			<div class="col-md-4">
    				<div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url(images/project-4.jpg);">
    					<div class="overlay"></div>
	    				<div class="text text-center p-4">
	    					<h3><a href="#">{{$value->service}}</a></h3>
	    					<span>{{$value->service_type}}</span>
	    				</div>
    				</div>
  				</div>
				  @endforeach
				  @endif
    		</div>
    	</div>
    </section>


    {{-- <section class="ftco-section" id="blog-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h1 class="big big-2">Blog</h1>
            <h2 class="mb-4">Our Blog</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a>
              <div class="text mt-3 float-right d-block">
              	<div class="d-flex align-items-center mb-3 meta">
	                <p class="mb-0">
	                	<span class="mr-2">June 21, 2019</span>
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p>
                </div>
                <h3 class="heading"><a href="single.html">Why Lead Generation is Key for Business Growth</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
              </a>
              <div class="text mt-3 float-right d-block">
              	<div class="d-flex align-items-center mb-3 meta">
	                <p class="mb-0">
	                	<span class="mr-2">June 21, 2019</span>
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p>
                </div>
                <h3 class="heading"><a href="single.html">Why Lead Generation is Key for Business Growth</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry">
              <a href="single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
              </a>
              <div class="text mt-3 float-right d-block">
              	<div class="d-flex align-items-center mb-3 meta">
	                <p class="mb-0">
	                	<span class="mr-2">June 21, 2019</span>
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p>
                </div>
                <h3 class="heading"><a href="single.html">Why Lead Generation is Key for Business Growth</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}

    <section class="ftco-section ftco-no-pt ftco-no-pb ftco-counter img" id="section-counter">
    	<div class="container">
				<div class="row d-md-flex align-items-center">
          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="100">0</strong>
                <span>Awards</span>
              </div>
            </div>
          </div>
          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="1200">0</strong>
                <span>Complete Projects</span>
              </div>
            </div>
          </div>
          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="1200">0</strong>
                <span>Happy Customers</span>
              </div>
            </div>
          </div>
          <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18">
              <div class="text">
                <strong class="number" data-number="500">0</strong>
                <span>Cups of coffee</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-hireme img margin-top" style="background-image: url(images/bg_1.jpg)">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-7 ftco-animate text-center">
						<h2>I'm <span>Available</span> for freelancing</h2>
						@if(!empty($abouts))
    <p>{{ $abouts->random()->quote }}</p>
@endif
						<p class="mb-0"><a href="#" class="btn btn-primary py-3 px-5">Hire me</a></p>
					</div>
				</div>
			</div>
		</section>

		
    <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
      <div class="container">
		@if(!empty($abouts))
		@foreach($abouts as $key => $value)
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h1 class="big big-2">Contact</h1>
            <h2 class="mb-4">Contact Me</h2>
            {{-- <p>{{$value->quote}}</p> --}}
			@if(!empty($abouts))
    <p>{{ $abouts->random()->quote }}</p>
@endif

          </div>
        </div>

        <div class="row d-flex contact-info mb-5">
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-map-signs"></span>
          		</div>
          		<h3 class="mb-4">Address</h3>
	            <p>{{$value->address}}</p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-phone2"></span>
          		</div>
          		<h3 class="mb-4">Contact Number</h3>
	            <p><a href="tel://{{$value->alt_mobile}}">{{$value->alt_mobile}}</a></p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-paper-plane"></span>
          		</div>
          		<h3 class="mb-4">Email Address</h3>
	            <p><a href="mailto:{{$value->email}}">{{$value->email}}</a></p>
	          </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex ftco-animate">
          	<div class="align-self-stretch box p-4 text-center">
          		<div class="icon d-flex align-items-center justify-content-center">
          			<span class="icon-globe"></span>
          		</div>
          		<h3 class="mb-4">Website</h3>
	            <p><a href="#">yoursite.com</a></p>
	          </div>
          </div>
        </div>

        <div class="row no-gutters block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="{{url('/add')}}" class="bg-light p-4 p-md-5 contact-form" method="post">
				@csrf
						
				<input type="hidden" name="id" value="@if(!empty($result)){{$result['id']}}@else{{ 0 }}@endif"  required />
              <div class="form-group">
				<input  value="@if(!empty($result)){{ $result['name'] }}@endif" type="text" required class="form-control" placeholder="Enter Your Name" name="name" >
			</div>
              <div class="form-group">
				<input  value="@if(!empty($result)){{ $result['email'] }}@endif" type="email" required class="form-control" placeholder="Enter Email" name="email" >
			</div>
              <div class="form-group">
				<input  value="@if(!empty($result)){{ $result['mobile'] }}@endif" type="tel" required class="form-control" placeholder="Enter Mobile No." name="mobile" >
			</div>
              <div class="form-group">
                <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group">
                <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5" name="submit">
              </div>
            </form>
          
          </div>

          <div class="col-md-6 d-flex">
          	<div class="img" style="background-image: url(images/about.jpg);"></div>
          </div>
        </div>
      </div>
	  @endforeach
	  @endif
    </section>

    @endsection