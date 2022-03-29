@extends('layouts.layouts_home')
@section('title', 'Homepage')
@section('content')
<section class="about-us">
    <div class="container">
        <div class="about-us-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="single-about-us">
                        <div class="about-us-txt">
                            <h2>about us</h2>
                            <p>
                                where entrepreneurs can easily find the right design for their company. The book cover for us is a very important part of the success of the book. Therefore, we entrust this to the experts and are finally very happy with the results.
                            </p>
                            <div class="project-btn">
                                <a href="#" class="project-view">learn more
                                </a>
                                <a href="#" class="project-view">Watch Video
                                </a>
                            </div>
                            <!--/.project-btn-->
                        </div>
                        <!--/.about-us-txt-->
                    </div>
                    <!--/.single-about-us-->
                </div>
                <!--/.col-->
                <div class="col-sm-6">
                    <div class="single-about-us">
                        <div class="about-us-img">
                            <img src="{{url('assets/home/images/about/about-part.jpg')}}" alt="about images">
                        </div>
                        <!--/.about-us-img-->
                    </div>
                    <!--/.single-about-us-->
                </div>
                <!--/.col-->
            </div>
            <!--/.row-->
        </div>
        <!--/.about-us-content-->
    </div>
    <!--/.container-->

</section>
<section class="service">
    <div class="container">
        <div class="service-details">
            <div class="section-header text-center">
                <h2>Our design services</h2>
            </div>
            <div class="service-content-one" id="service-content-one">
                <div class="row">
                    @foreach ($categories as $showcategories)
                    <div class="col-sm-2 col-xs-12">
                        <div class="service-single text-center">
                            <div class="service-img">
                                <img src="{{Storage::url($showcategories->image)}}" alt="service image" />
                            </div>
                            <div class="service-txt">
                                <h2>
                                    <a href="#">{{$showcategories->name}}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" id="seeall">see all categories</button>
                </div>
            </div>
            <div class="service-content-one" id="service-content-two">
                <div class="row">
                    @foreach ($categoriesall as $showcategoriesall)
                    <div class="col-sm-2 col-xs-12">
                        <div class="service-single text-center">
                            <div class="service-img">
                                <img src="{{Storage::url($showcategoriesall->image)}}" alt="service image" />
                            </div>
                            <div class="service-txt">
                                <h2>
                                    <a href="#">{{$showcategoriesall->name}}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" id="hideall">hide all categories</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="statistics">
    <div class="container">
        <div class="statistics-counter ">
            <div class="col-md-4 col-sm-6">
                <div class="single-ststistics-box">
                    <div class="statistics-img">
                        <img src="{{url('assets/home/images/counter/counter1.png')}}" alt="counter-icon" />
                    </div>
                    <div class="statistics-content">
                        <div class="counter">{{App\Models\Project::where('catagories_project','contest')->count()}}
                        </div>
                        <h3>freelance designers</h3>
                    </div>
                </div>
            </div>
            <!--/.col-->
            <div class="col-md-4 col-sm-6">
                <div class="single-ststistics-box">
                    <div class="statistics-img">
                        <img src="{{url('assets/home/images/counter/counter2.png')}}" alt="counter-icon" />
                    </div>
                    <div class="statistics-content">
                        <div class="counter">{{App\Models\Project::where('catagories_project','direct')->count()}}
                        </div>
                        <h3>designs per project</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="single-ststistics-box">
                    <div class="statistics-img">
                        <img src="{{url('assets/home/images/counter/counter3.png')}}" alt="counter-icon" />
                    </div>
                    <div class="statistics-content">
                        <div class="counter">{{App\Models\Project::where('is_active','close')->count()}}</div>
                        <h3>completed projects</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="project" class="project">
    <div class="container">
        <div class="project-details">
            <div class="project-header text-left">
                <h2>Get inspired by beautiful design</h2>
            </div>
            <div class="project-content">
                <div class="gallery-content">
                    <div class="isotope">
                        <div class="row">
                            @foreach ($project as $showproject)
                            @php
                                $detailcontest  = DB::table('result_contests')->where('contest_id',$showproject->id)->where('is_active','winner')->first();
                                $desainers      = DB::table('result_contests')->where('contest_id',$showproject->id)->distinct()->count('user_id_worker');
                                $desains        = DB::table('result_contests')->where('contest_id',$showproject->id)->count();
                            @endphp
                            <div class="col-md-3 col-sm-12">
                                <div class="item">
                                    <img src="{{Storage::url('resultcontest/' . $detailcontest->filecontest)}}" alt="project image" />
                                    <div class="isotope-overlay">
                                        <div class="d-flex flex-row">
                                            <div class="text-center">
                                                <p>{{$desains}}</p>
                                                <h3>Desain</h3>
                                            </div>
                                            <div class="text-center">
                                                <p>{{$desainers}}</p>
                                                <h3>Desainer</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="project-btn text-center">
            <a href="project.html" class="project-view">view all
            </a>
        </div>
    </div>
</section>
<section class="contact">
    <div class="container">
        <div class="contact-details">
            <div class="section-header contact-head  text-center">
                <h2>contact us</h2>
            </div>
            <div class="contact-content">
                <div class="row">
                    <div class="col-sm-offset-1 col-sm-5">
                        <div class="single-contact-box">
                            <div class="contact-right">
                                <div class="contact-adress">
                                    <div class="contact-office-address">
                                        <h3>contact info</h3>
                                        <p>

                                        </p>
                                        <div class="contact-online-address">
                                            <div class="single-online-address">
                                                <i class="fa fa-phone"></i>
                                                +11253678958
                                            </div>
                                            <div class="single-online-address">
                                                <i class="fa fa-envelope-o"></i>
                                                <span>info@jobsaja.com</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-office-address">
                                        <h3>social partner</h3>
                                        <div class="contact-icon">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                                </li>
                                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="single-contact-box">
                            <div class="contact-form">
                                <h3>Leave us a Massage Here</h3>
                                <form action="/" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" placeholder="Email"
                                            name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="phone" placeholder="Phone"
                                            name="phone">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea class="form-control" rows="7" id="comment" name="comment"
                                                    placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="single-contact-btn pull-right">
                                                <button class="contact-btn" type="submit">send message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="hm-footer">
    <div class="container">
        <div class="hm-footer-details">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="hm-footer-widget">
                        <div class="hm-foot-title ">
                            <div class="logo">
                                <a href="index.html">
                                    <img src="{{url('assets/dashboard/images/logo3.png')}}" alt="logo" width="200px" />
                                </a>
                            </div>
                        </div>
                        <div class="hm-foot-para">
                            <p>
                                Lorem ipsum dolor sit amt conetur adcing elit. Sed do eiusod tempor utslr. Ut
                                laboris nisi ut aute irure dolor in rein velit esse.
                            </p>
                        </div>
                        <div class="hm-foot-icon">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-md-2 col-sm-6 col-xs-12">
                    <div class="hm-footer-widget">
                        <div class="hm-foot-title">
                            <h4>Useful Links</h4>
                        </div>
                        <div class="footer-menu ">
                            <ul class="">
                                <li><a href="index.html">Home</a></li>
                                <li><a href="about.html">About</a></li>
                                <li><a href="services.html">Service</a></li>
                                <li><a href="portfolio.html">Portfolio</a></li>
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3 col-sm-6 col-xs-12">
                    <div class="hm-footer-widget">
                        <div class="hm-foot-title">
                            <h4>from the news</h4>
                        </div>
                        <div class="hm-para-news">
                            <a href="blog_single.html">
                                The Pros and Cons of Starting an Online Business.
                            </a>
                            <span>12th June 2017</span>
                        </div>
                        <div class="footer-line">
                            <div class="border-bottom"></div>
                        </div>
                        <div class="hm-para-news">
                            <a href="blog_single.html">
                                The Pros and Cons of Starting an Online Business.
                            </a>
                            <span>12th June 2017</span>
                        </div>
                    </div>
                </div>
                <div class=" col-md-3 col-sm-6  col-xs-12">
                    <div class="hm-footer-widget">
                        <div class="hm-foot-title">
                            <h4> Our Newsletter</h4>
                        </div>
                        <div class="hm-foot-para">
                            <p class="para-news">
                                Subscribe to our newsletter to get the latest News and offers..
                            </p>
                        </div>
                        <div class="hm-foot-email">
                            <div class="foot-email-box">
                                <input type="text" class="form-control" placeholder="Email Address">
                            </div>
                            <div class="foot-email-subscribe">
                                <button type="button">go</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $('#service-content-two').hide();
        $('#seeall').click(function(){
            $('#service-content-two').show();
            $('#service-content-one').hide();
        });
        $('#hideall').click(function(){
            $('#service-content-one').show();
            $('#service-content-two').hide();
        });
    })
</script>
@endpush
