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

// Define workout categories with their background images
$workoutCategories = [
    'chest' => [
        'name' => 'Chest',
        'image' => 'chest-workout.jpg',
        'description' => 'Build a strong and defined chest'
    ],
    'back' => [
        'name' => 'Back',
        'image' => 'back-workout.jpg',
        'description' => 'Develop a powerful back'
    ],
    'legs' => [
        'name' => 'Legs',
        'image' => 'legs-workout.jpg',
        'description' => 'Strengthen your lower body'
    ],
    'shoulders' => [
        'name' => 'Shoulders',
        'image' => 'shoulders-workout.jpg',
        'description' => 'Build strong and broad shoulders'
    ],
    'arms' => [
        'name' => 'Arms',
        'image' => 'arms-workout.jpg',
        'description' => 'Develop impressive arm muscles'
    ],
    'core' => [
        'name' => 'Core',
        'image' => 'core-workout.jpg',
        'description' => 'Strengthen your core muscles'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Selection - FIT TRACK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .workout-card {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .workout-card:hover {
            transform: scale(1.05);
        }
        .workout-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7));
        }
        .workout-content {
            position: relative;
            z-index: 1;
        }
        body{
            background-image: url('pexels-leonardho-1552242.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="min-h-screen">

    <!-- Header -->
    <header class="bg-white/0 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                   <img src="cooltext479659028948576.png" alt="FIT TRACK" class="h-8 w-auto">
                    </div>
                </div>
                <div class="flex items-center">
                   
                    <a href="dashboard.php" class="text-gray-700 rounded-lg bg-gray-900 text-white px-4 py-2 hover:text-blue-500 mr-4">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                   
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold  font-futura text-white mb-8 text-center">What You Want To Train Today</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($workoutCategories as $category => $details): ?>
                <a href="exercises.php?category=<?php echo $category; ?>" class="workout-card rounded-lg shadow-lg">
                    <div class="h-64 bg-cover bg-center" style="background-image: url('images/<?php echo $details['image']; ?>');">
                        <div class="workout-content h-full flex flex-col justify-end p-6 text-white">
                            <h2 class="text-2xl font-bold mb-2"><?php echo $details['name']; ?></h2>
                            <p class="text-sm opacity-90"><?php echo $details['description']; ?></p>
                            <div class="mt-4 flex items-center">
                                <span class="text-sm">View Exercises</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-black shadow mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <p class="text-gray-500 text-sm">© 2024 FIT TRACK. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-white hover:text-gray-700">Privacy Policy</a>
                    <a href="#" class="text-white hover:text-gray-700">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html> 