<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background-image: url({{ asset('/img/hotel.jpg') }}); /* Ganti dengan gambar latar Anda */
            background-size: cover;
            background-position: center;
            height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }
        .room-status {
            font-size: 0.9rem;
            font-weight: bold;
        }
        .room-status.available {
            color: green;
        }
        .room-status.unavailable {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="hero">
        <div class="text-center">
            <h1 class="display-4 fw-bold">Welcome to Our Hotel</h1>
            <p class="lead">Find the perfect room for your stay</p>
        </div>
    </div>

    <!-- Available Rooms Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Available Rooms</h2>
        <div class="row">
            @forelse($rooms as $room)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('/storage/' . $room->image) }}" class="card-img-top" alt="Room Image">
                        <div class="card-body">
                            <h5 class="card-title">Room {{ $room->room_number }} - {{ $room->type }}</h5>
                            <p class="fw-bold">Price: Rp{{ number_format($room->price, 2) }}</p>
                            <p class="room-status {{ $room->status == 'available' ? 'available' : 'unavailable' }}">
                                Status: {{ ucfirst($room->status) }}
                            </p>
                            <p class="card-text">{{ $room->description }}</p>
                            {{-- @if($room->status == 'available')
                                <a href="#" class="btn btn-primary">Book Now</a>
                            @else
                                <button class="btn btn-secondary" disabled>Unavailable</button>
                            @endif --}}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">No rooms are currently available.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Services Section -->
    <div class="bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-4">Our Services</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('/img/service.jpg') }}" class="card-img-top" alt="Service 1">
                        <div class="card-body">
                            <h5 class="card-title">Room Service</h5>
                            <p class="card-text">Enjoy 24/7 room service with a variety of meals and drinks available at your convenience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('/img/spa.jpg') }}" class="card-img-top" alt="Service 2">
                        <div class="card-body">
                            <h5 class="card-title">Spa & Wellness</h5>
                            <p class="card-text">Relax and rejuvenate at our in-house spa, with professional therapists to pamper you.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ asset('/img/meeting.jpg') }}" class="card-img-top" alt="Service 3">
                        <div class="card-body">
                            <h5 class="card-title">Meeting Room</h5>
                            <p class="card-text">We offer fully equipped conference rooms for meetings and events.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="container my-5" id="about">
        <h2 class="text-center mb-4">About Us</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <p style="text-align: center">We are a luxury hotel providing the best services for your comfort. With a variety of room types and amenities, we ensure that every guest has a memorable stay. Whether you're here for business or leisure, our hotel offers the perfect blend of relaxation and convenience.</p>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Contact Us</h2>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3 mb-4">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Terms &amp; Conditions</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-white">Help</a></li>
                        <li><a href="#" class="text-white">Rooms</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Our Location</a></li>
                        <li><a href="#" class="text-white">The Hosts</a></li>
                        <li><a href="#about" class="text-white">About</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                        <li><a href="#" class="text-white">Restaurant</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Visit Us</h5>
                    <p>Our Hotel, Main Street, City</p>
                    <p>Email: contact@ourhotel.com</p>
                    <p>Phone: +123 456 7890</p>
                </div>
                <div class="col-md-3 mb-4">
                    <p>Sign up for our newsletter</p>
                    <form action="#" class="footer-newsletter">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Your email...">
                            <button class="btn btn-outline-light" type="submit"><span class="fa fa-paper-plane"></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-6 text-left">
                    <p>&copy; <script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" class="text-white">Colorlib</a></p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="#" class="text-white"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="text-white"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="text-white"><i class="fa fa-tripadvisor"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
