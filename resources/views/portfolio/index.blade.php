@extends('layouts.app')

@section('title', 'Geeta Kuikel Neupane - Portfolio')
@section('description', 'Portfolio of Geeta Kuikel Neupane - Computer Science Faculty at Merryland College')

@section('content')
<!-- Hero Section -->
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content" data-aos="fade-right">
                <img src="/images/geeta-profile.jpg" alt="Geeta Kuikel Neupane" class="profile-img" onerror="this.src='https://via.placeholder.com/300x300/2c3e50/ffffff?text=Geeta+Kuikel'">
                <h1 class="hero-title">Geeta Kuikel Neupane</h1>
                <h3 class="hero-subtitle">Faculty at Merryland College</h3>
                <p class="hero-description">Dynamic IT educator and event manager with 5+ years of multi-industry experience. Passionate about programming, teaching, and creating innovative solutions.</p>
                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="#contact" class="btn btn-light btn-lg">
                        <i class="fas fa-envelope me-2"></i>Get In Touch
                    </a>
                    <a href="{{ route('resume.download') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-download me-2"></i>Download Resume
                    </a>
                </div>
                <div class="social-links">
                    <a href="https://github.com/geets11" target="_blank" title="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/geeta-kuikel-neupane-67282b174/" target="_blank" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="mailto:kuikelgeeta6@gmail.com" title="Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="text-center">
                    <i class="fas fa-laptop-code" style="font-size: 15rem; opacity: 0.1;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">About Me</h2>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="text-center mb-5" data-aos="fade-up">
                    <p class="lead">
                        Dynamic and adaptable IT Student, educator, and event manager with over 5 years of multi-industry experience across sales, promotions, and event management. Strong expertise in programming languages, classroom instruction, leadership, and public speaking.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-5">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Featured Projects</h2>
        <div class="row">
            @foreach($projects as $index => $project)
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="custom-card project-card h-100">
                    <div class="position-relative overflow-hidden">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="img-fluid" style="height: 250px; width: 100%; object-fit: cover;" onerror="this.src='https://via.placeholder.com/500x300/3498db/ffffff?text={{ urlencode($project['title']) }}'">
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge {{ $project['status'] == 'Completed' ? 'bg-success' : 'bg-warning' }}">
                                {{ $project['status'] }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold mb-2">{{ $project['title'] }}</h5>
                        <p class="text-muted mb-3">{{ $project['description'] }}</p>
                        
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2">Technologies:</h6>
                            @foreach($project['technologies'] as $tech)
                                <span class="badge bg-primary me-1 mb-1">{{ $tech }}</span>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if(isset($project['github']))
                                    <a href="{{ $project['github'] }}" class="btn btn-outline-primary btn-sm me-2" target="_blank">
                                        <i class="fab fa-github me-1"></i>Code
                                    </a>
                                @endif
                                @if(isset($project['demo']))
                                    <a href="{{ $project['demo'] }}" class="btn btn-primary btn-sm" target="_blank">
                                        <i class="fas fa-external-link-alt me-1"></i>Demo
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section id="testimonials" class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">What People Say</h2>
        <div class="row">
            @foreach($testimonials as $index => $testimonial)
            <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="testimonial-card">
                    <img src="{{ $testimonial['image'] }}" 
                         alt="{{ $testimonial['name'] }}" 
                         class="testimonial-img"
                         onerror="this.src='https://via.placeholder.com/150x150/{{ ['2c3e50', 'e74c3c', '27ae60'][$index] }}/ffffff?text={{ substr($testimonial['name'], 0, 2) }}'">
                    <blockquote class="mb-3">
                        <i class="fas fa-quote-left text-primary me-2"></i>
                        {{ $testimonial['text'] }}
                        <i class="fas fa-quote-right text-primary ms-2"></i>
                    </blockquote>
                    <h6 class="fw-bold">{{ $testimonial['name'] }}</h6>
                    <small class="text-muted">{{ $testimonial['position'] }}</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Get In Touch</h2>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-up">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" data-aos="fade-up">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row mb-5">
                    <div class="col-md-4 mb-4" data-aos="fade-up">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-phone fa-3x text-primary"></i>
                            </div>
                            <h5>Phone</h5>
                            <p class="text-muted">+977 9752275229</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-envelope fa-3x text-primary"></i>
                            </div>
                            <h5>Email</h5>
                            <p class="text-muted">kuikelgeeta6@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="mb-3">
                                <i class="fas fa-map-marker-alt fa-3x text-primary"></i>
                            </div>
                            <h5>Location</h5>
                            <p class="text-muted">Biratnagar-5, Morang<br>Nepal</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form" data-aos="fade-up">
                    <h4 class="text-center mb-4">Send me a message</h4>
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address *</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject *</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{ old('subject') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
