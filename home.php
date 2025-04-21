<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIT TRACK - Fitness Tracking Made Simple</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <head>
        <!-- Existing meta tags -->
        
        <!-- Add font-face here -->
        <style>
            @font-face {
                font-family: 'Futura';
                src: url('fonts/futura-extra-bold-condensed.woff2') format('woff2'),
                     url('fonts/futura-extra-bold-condensed.woff') format('woff');
                font-weight: 800;
                font-stretch: condensed;
            }
            /* slide-in */
            @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .animate-slide-in {
            animation: slideIn 0.8s ease-out forwards;
        }
        </style>
    </head>
    <!-- Add to HTML head -->
<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">


</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white text-white fixed w-full top-0 z-50 shadow-lg transition-transform duration-300 ease-in-out ">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-3xl text-gray-900 font-bold futura-bold font-extrabold">
                FIT TRACK
            </div>
            <div class="space-x-6 flex items-center">
                
               
                
                <button class="bg-gray-900 hover:bg-blue-600 px-4 py-2 rounded-lg ml-4 transition-colors opacity-0 translate-y-[50px] 
                animate-slide-in delay-100">
                    <a href="login.php">Login</a>
                </button>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative h-screen flex items-center justify-center mt-16">
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/30"></div>
        <img src="h1_hero.png" 
             alt="Fitness background" 
             class="absolute inset-0 w-full h-full object-cover">
        
        <div class="relative container mx-auto px-6 text-center text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 opacity-0 translate-y-[50px] 
            animate-slide-in delay-200">Transform Your Fitness Journey</h1>
            <p class="text-xl md:text-2xl mb-8 opacity-0 translate-y-[50px] 
            animate-slide-in delay-100">Track workouts, calculate calories, and monitor progress in one place</p>
            <button class="bg-gray-900 hover:bg-blue-600 text-white px-8 py-3 rounded-full text-lg transition-colors opacity-0 translate-y-[50px] 
            animate-slide-in delay-100">
                <a href="signup.php">Get Started</a>  
            </button>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">What Our Clients Say</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-500 rounded-xl p-6 shadow-lg transform transition duration-500 hover:scale-105">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-4">
                            <img src="client1.jpg" alt="Client 1" class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">Sam</h3>
                            <p class="text-white mb-4">"FIT TRACK has transformed my fitness journey. The BMI calculator helped me understand my health better!"</p>
                            <div class="flex justify-center text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-gray-500 rounded-xl p-6 shadow-lg transform transition duration-500 hover:scale-105">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-4">
                            <img src="client2.jpg" alt="Client 2" class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">Michael Chen</h3>
                            <p class="text-white mb-4">"The progress tracking features are amazing. I can see my improvements over time!"</p>
                            <div class="flex justify-center text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-gray-500 rounded-xl p-6 shadow-lg transform transition duration-500 hover:scale-105">
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 rounded-full overflow-hidden mb-4">
                            <img src="client3.jpg" alt="Client 3" class="w-full h-full object-cover">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-semibold text-white mb-2">Rahul oberoy </h3>
                            <p class="text-white mb-4">"The calorie calculator is so accurate and easy to use. It's become an essential part of my daily routine."</p>
                            <div class="flex justify-center text-yellow-400">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 bg-white">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 text-center">
        <!-- People Joined -->
        <div class="bg-gray-100 rounded-lg p-6 shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">People Joined</h2>
            <p class="text-5xl font-extrabold text-blue-600 counter" data-target="10000">0</p>
            <p class="text-gray-600 mt-2">Join our growing community of fitness enthusiasts!</p>
        </div>
        <!-- People Transformed -->
        <div class="bg-gray-100 rounded-lg p-6 shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">People Transformed</h2>
            <p class="text-5xl font-extrabold text-green-600 counter" data-target="5000">0</p>
            <p class="text-gray-600 mt-2">See the amazing transformations achieved with FIT TRACK!</p>
        </div>
    </div>
</section>
<!-- filepath: c:\xampp\htdocs\fitrack\home.php -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Map Section -->
        <div class="relative">
            <img src="india-map2.png" alt="Map of India" class="w-full h-auto rounded-lg shadow-lg">
            <!-- Example location markers -->
            <div class="absolute top-1/4 left-1/3">
                <i class="fas fa-map-marker-alt text-red-600 text-3xl"></i>
                <p class="text-sm text-gray-800 font-bold">Delhi</p>
            </div>
            <div class="absolute top-1/2 left-1/4">
                <i class="fas fa-map-marker-alt text-red-600 text-3xl"></i>
                <p class="text-sm text-gray-800 font-bold">Mumbai</p>
            </div>
           
            <div class="absolute top-1/3 left-2/3">
                <i class="fas fa-map-marker-alt text-red-600 text-3xl"></i>
                <p class="text-sm text-gray-800 font-bold">Kolkata</p>
            </div>
        </div>

        <!-- States and Cities Section -->
        <div class="text-center bg-gray-100 rounded-lg p-6 shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">We Are In</h2>
            <p class="text-5xl font-extrabold text-gray-900">4 States</p>
            <p class="text-5xl font-extrabold text-gray-900">50 Cities</p>
            <p class="text-gray-600 mt-4">We are proud to serve fitness enthusiasts across India!</p>
        </div>
    </div>
</section>

   <!-- filepath: c:\xampp\htdocs\fitrack\home.php -->
<div class="rounded-lg bg-gray-50  text-white text-center mt-10 mb-8 px-8 py-10 shadow-2xl">
    <h1 class="font-bold text-5xl text-black font-serif mb-6">About Us</h1>
    <p class="text-lg text-black md:text-xl font-light leading-relaxed mb-8">
        "FIT TRACK is a comprehensive fitness tracking platform designed to help individuals achieve their health and wellness goals. 
        Our user-friendly interface allows you to easily track your workouts, monitor your progress, and calculate your BMI and calorie intake. 
        Whether you're a beginner or an experienced fitness enthusiast, FIT TRACK provides the tools you need to stay motivated and on track. 
        Join our community today and take the first step towards a healthier you!"
    </p>
    <h1 class="font-bold text-5xl text-black font-serif mt-10 mb-6">Our Mission</h1>
    <p class="text-lg md:text-xl  text-black font-light leading-relaxed">
        "Our mission is to empower individuals to take control of their fitness journey by providing them with the resources and support they need to succeed. 
        We believe that everyone deserves access to quality fitness tracking tools, and we're committed to making that a reality. 
        With FIT TRACK, you can easily set goals, track your progress, and stay motivated every step of the way."
    </p>
    <div class="mt-10">
        <button class="bg-white text-blue-500 hover:text-white hover:bg-blue-600 font-bold py-3 px-8 rounded-full shadow-lg transition-all duration-300">
            Learn More
        </button>
    </div>
</div>
<!-- filepath: c:\xampp\htdocs\fitrack\home.php -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Company Section -->
        <div>
            <h3 class="text-xl font-bold mb-4">COMPANY</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Press Release</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Employee Wellness</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Privacy Policy</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Terms & Conditions</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Preferred Vendors</a></li>
            </ul>
        </div>

        <!-- Gyms Section -->
        <div>
            <h3 class="text-xl font-bold mb-4">GYMS</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-400 hover:text-white transition">Find a Gym</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Own a Gym</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Franchise Login</a></li>
            </ul>
        </div>

        <!-- Members Section -->
        <div>
            <h3 class="text-xl font-bold mb-4">MEMBERS</h3>
            <ul class="space-y-2">
                <li><a href="#" class="text-gray-400 hover:text-white transition">FAQs</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Contact Us</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Events & Gallery</a></li>
                <li><a href="#" class="text-gray-400 hover:text-white transition">Get Marathon Ready</a></li>
            </ul>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-8 pt-6 text-center">
        <p class="text-gray-500 text-sm">&copy; 2025 FIT TRACK. All rights reserved.</p>
    </div>
</footer>

    <script>
        let lastScroll = 0;
        const header = document.querySelector('header');
        
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > lastScroll && currentScroll > 100) {
                // Scroll down - hide header
                header.classList.add('-translate-y-full');
            } else {
                // Scroll up - show header
                header.classList.remove('-translate-y-full');
            }
            
            // Reset header at page top
            if (currentScroll < 10) {
                header.classList.remove('-translate-y-full');
            }
            
            lastScroll = currentScroll;
        });
        // slide-in-text
        document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('[class*="animate-slide-in"]');
        elements.forEach(element => {
            element.classList.remove('opacity-0', 'translate-y-[50px]');
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Adjust speed for animation

        counters.forEach(counter => {
            const animateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const current = +counter.innerText;
                const increment = target / speed;

                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(animateCounter, 10);
                } else {
                    counter.innerText = target;
                }
            };

            // Trigger animation when the counter is in view
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter();
                        observer.unobserve(counter); // Stop observing after animation
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(counter);
        });
    });
    document.addEventListener('DOMContentLoaded', () => {
        const counters = document.querySelectorAll('.counter');
        const speed = 200; // Adjust speed for animation

        counters.forEach(counter => {
            const animateCounter = () => {
                const target = +counter.getAttribute('data-target');
                const current = +counter.innerText;
                const increment = target / speed;

                if (current < target) {
                    counter.innerText = Math.ceil(current + increment);
                    setTimeout(animateCounter, 10);
                } else {
                    counter.innerText = target;
                }
            };

            // Trigger animation when the counter is in view
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter();
                        observer.unobserve(counter); // Stop observing after animation
                    }
                });
            }, { threshold: 0.5 });

            observer.observe(counter);
        });
    });

    </script>
</body>
</html>