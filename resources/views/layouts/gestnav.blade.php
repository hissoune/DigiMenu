
 <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                    <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    
                     @if (Route::has('login'))
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <a href="menu.html" class="nav-item nav-link">Menu</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu m-0">
                                <a href="booking.html" class="dropdown-item">Booking</a>
                                <a href="team.html" class="dropdown-item">Our Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="{{route('client')}}" class="nav-item nav-link">Client</a>
                    </div>
                    
                        @auth
                        @role('Admin')
                        <a href="{{ url('/dashboard') }}" class="fnav-item nav-link">Dashboard</a>
                        @endrole
                        @role('owner')
                        <a href="{{ url('/dashboard_oner') }}" class="fnav-item nav-link">Dashboard</a>
                        @endrole
                        @role('operator')
                        <a href="{{ url('/dashboard_oper') }}" class="fnav-item nav-link">Dashboard</a>
                        @endrole                        @else
                            <a href="{{ route('login') }}" class="nav-item nav-link">Log in</a>
            
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4">Register</a>
                    @endif
                </div>
                @endauth
>>>>>>> af14c11e4d3c919e0bc9f916d49deeb9c5c19c52
                @endif
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container my-5 py-5">
                    <div class="row align-items-center g-5">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                            <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                            @auth
                                
                            @else
                                
                            
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLef">Register</a>
                            @endif
                                
                            @endauth
                        </div>
                        <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                            <img class="img-fluid" src="img/hero.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>