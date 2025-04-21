<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

// Get user information
$stmt = $pdo->prepare("SELECT name FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FIT TRACK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
       
    </style>
</head>
<body class="min-h-screen bg-white">
    <!-- Header -->
    <header class="absolute bg-white/30 fixed w-full h-[82px] z-50 sticky top-0 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-[100px] w-[100px] px-2 py-2" src="FITRACK.png" alt="FIT TRACK">
                        <h1 class="text-4xl font-bold font-futura">FITRACK</h1>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-black font-medium text-2xl font-bold font-futura">Welcome, <?php echo htmlspecialchars($user['name']); ?></span>
                    <div class="relative group ml-4">
                        <!-- Hamburger Icon -->
                        <div class="flex flex-col justify-between w-6 h-5 cursor-pointer">
                            <span class="block h-1 bg-black rounded"></span>
                            <span class="block h-1 bg-black rounded"></span>
                            <span class="block h-1 bg-black rounded"></span>
                        </div>
                        <!-- Dropdown on Hover -->
                        <div class="absolute right-0 mt-2 w-40 bg-black rounded-md shadow-lg opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto transition-opacity duration-300 pointer-events-none z-50">
                            <
                            <a href="logout.php" class="block px-4 py-2 text-white hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Slideshow Container -->
    <div class=" mt-8 px-4 h-[700px] w-[100%]" data-aos="fade-up">
        <div class="">
            <video autoplay loop muted playsinline class="absolute top-0 left-0 w-full h-full object-cover z-[-2]">
                <source src="Orange Black Modern GYM Video.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>

    <div class="bg-white text-black px-10 mt-6 mb-6" data-aos="zoom-in-up">
    <!-- Heading Section -->
    <div class="text-center mt-6 pt-6">
        <h1 class="text-6xl font-bold mb-4">Give a Boost to Your Fitness</h1>
        
    </div>

    <!-- Flex Container for Image and Text -->
    <div class="flex items-center justify-between mt-6 h-[500px]">
        <!-- Image Section -->
        <div class="w-1/2 mt-12">
            <img src="gym_image.jpg" alt="Progress Tracker" class="h-[550px] w-full object-cover shadow-lg">
        </div>

        <!-- Text Section -->
        <div class="flex flex-col justify-center w-1/2 pl-10">
            <h2 class="text-6xl font-bold mb-6">JOIN OUR GYM</h2>
            <p class="text-lg mb-8">
                we are now open in various locations and we are now providing people real guidance for fitness
            </p>
            <a href="https://docs.google.com/forms/d/1hjWTvOgsn7hXgLXBESW9WXhcofGgmxsvurUPEAsbogk/edit">
                <button class="bg-black text-white font-bold h-[60px] w-[150px] py-3 px-2 hover:bg-gray-800 transition-all duration-300">
                    JOIN
                </button>
            </a>
        </div>
    </div>
</div>

    <!-- Features Section -->
    <div class="text-center mt-12" data-aos="fade-down">
        <h1 class="text-6xl font-bold text-black">Our Features</h1>
    </div>

    <div class="flex items-center justify-between bg-white text-black h-[500px] px-10 mt-10" data-aos="fade-right">
        <!-- Text Section -->
        <div class="flex flex-col justify-center w-1/2">
            <h1 class="text-6xl font-bold mb-6">FULL-BODY FITNESS</h1>
            <p class="text-lg mb-8">
                Get full body workout charts at one place. Discover workouts.
            </p>
            <a href="workout.php">
                <button class="bg-black text-white font-bold h-[60px] w-[150px] py-3 px-2 hover:bg-gray-800 transition-all duration-300">
                    Workouts
                </button>
            </a>
        </div>
        <!-- Image Section -->
        <div class="w-1/2" data-aos="fade-left">
            <img src="fitness_image.jpg" alt="Full-Body Fitness" class="h-[500px] w-[850px] object-cover">
        </div>
    </div>

    <div class="flex items-center justify-between bg-white text-black h-[500px] px-10 mt-6" data-aos="zoom-in-up">
        <!-- Image Section -->
        <div class="w-1/2">
            <img src="progress_image.jpg" alt="Progress Tracker" class="h-[500px] w-full object-cover shadow-lg">
        </div>
        <!-- Text Section -->
        <div class="flex flex-col justify-center w-1/2 pl-10">
            <h1 class="text-6xl font-bold mb-6">Track your Fitness</h1>
            <p class="text-lg mb-8">
                Get detailed progress and track your fitness journey.
            </p>
            <a href="progress.php">
                <button class="bg-black text-white font-bold h-[60px] w-[150px] py-3 px-2 hover:bg-gray-800 transition-all duration-300">
                    PROGRESS
                </button>
            </a>
        </div>
    </div>
    <!-- filepath: c:\xampp\htdocs\fitrack\dashboard.php -->
<div class="h-full w-full bg-white text-black mt-6 text-center" data-aos="fade-up">
    <h1 class="text-6xl font-bold mb-6">Explore More</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 px-10">
        <!-- Box 1 -->
        <a href="bmi.php" class="relative group">
            <div class="h-[300px] w-full bg-cover bg-center rounded-lg shadow-lg transition-transform transform hover:scale-105" 
                 style="background-image: url('bminew_image.jpg');">
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <h2 class="text-3xl font-bold text-white">BMI</h2>
                </div>
            </div>
        </a>

        <!-- Box 2 -->
        <a href="calorie.php" class="relative group">
            <div class="h-[300px] w-full bg-cover bg-center rounded-lg shadow-lg transition-transform transform hover:scale-105" 
                 style="background-image: url('calor1_image.jpg');">
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <h2 class="text-3xl font-bold text-white">Calories</h2>
                </div>
            </div>
        </a>

        <!-- Box 3 -->
        <a href="calor1.php" class="relative group">
            <div class="h-[300px] w-full bg-cover bg-center rounded-lg shadow-lg transition-transform transform hover:scale-105" 
                 style="background-image: url('calor_counter.jpg');">
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <h2 class="text-3xl font-bold text-white">calorie intake</h2>
                </div>
            </div>
        </a>
    </div>
</div>

    <!-- Events Section -->
    <div class="h-full w-full bg-white text-black mt-6 text-center" data-aos="fade-up">
        <h1 class="text-6xl font-bold mb-6">Events</h1>
        <div class="flex">
            <div class="w-1/2 h-full" data-aos="fade-right">
                <img src="slides1.jpg" alt="Community" class="h-[400px] w-full object-cover">
            </div>
            <div class="w-1/2 h-full text-center" data-aos="fade-left">
                <h1 class="text-6xl font-bold mb-6">Run For Community</h1>
                <p class="text-lg mb-8">
                    Join us for a run to support our community.
                    A marathon for the community is not just a race; it’s a celebration of unity, health, and resilience. 
                    It brings people together from all walks of life, promoting fitness while fostering a sense of belonging.
                     Participants—whether seasoned runners, casual joggers, or walkers—gather with a shared goal: to challenge themselves and support a meaningful cause.
                </p>
                <a href="events.php">
                    <button class="bg-black text-white font-bold h-[60px] w-[150px] py-3 px-2 hover:bg-gray-800 transition-all duration-300">
                        EVENTS
                    </button>
                </a>
            </div>
        </div>
    </div>
    <footer class="bg-black text-white py-12 mt-4">
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


    <!-- AOS Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: false,
            mirror: true,

        });
    </script>
</body>
</html>
