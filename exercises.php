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

// Get category from URL
$category = isset($_GET['category']) ? $_GET['category'] : 'chest';

// Define exercises for each category with more exercises
$exercises = [
    'chest' => [
        [
            'name' => 'Barbell Bench Press',
            'description' => 'The king of chest exercises. Targets the entire chest, shoulders, and triceps.',
            'video' => 'https://www.youtube.com/embed/rT7DgCr-3pg',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Barbell, Bench'
        ],
        [
            'name' => 'Incline Dumbbell Press',
            'description' => 'Focuses on the upper chest and front deltoids. Great for building upper chest mass.',
            'video' => 'https://www.youtube.com/embed/0G2_XV7slIg',
            'sets' => '3-4',
            'reps' => '10-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Dumbbells, Incline Bench'
        ],
        [
            'name' => 'Cable Fly',
            'description' => 'Isolates the chest muscles and helps develop the inner chest. Provides constant tension.',
            'video' => 'https://www.youtube.com/embed/taI4XduLpTk',
            'sets' => '3',
            'reps' => '12-15',
            'difficulty' => 'Beginner',
            'equipment' => 'Cable Machine'
        ],
        [
            'name' => 'Decline Bench Press',
            'description' => 'Targets the lower chest. Great for developing overall chest thickness.',
            'video' => 'https://www.youtube.com/embed/0fN27X-2mOQ',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Barbell, Decline Bench'
        ]
    ],
    'back' => [
        [
            'name' => 'Pull-ups',
            'description' => 'A fundamental back exercise that targets the entire back and biceps.',
            'video' => 'https://www.youtube.com/embed/eGo4IYlbE5g',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Pull-up Bar'
        ],
        [
            'name' => 'Barbell Rows',
            'description' => 'Builds thickness in the middle back. Essential for overall back development.',
            'video' => 'https://www.youtube.com/embed/9efgcAjQe7E',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Barbell'
        ],
        [
            'name' => 'Lat Pulldown',
            'description' => 'Great for developing the latissimus dorsi. Perfect for those who can\'t do pull-ups yet.',
            'video' => 'https://www.youtube.com/embed/CAwf7n6Luuc',
            'sets' => '3',
            'reps' => '10-12',
            'difficulty' => 'Beginner',
            'equipment' => 'Lat Pulldown Machine'
        ],
        [
            'name' => 'T-Bar Rows',
            'description' => 'Excellent for building back thickness and strength.',
            'video' => 'https://www.youtube.com/embed/j3Igk5nyZE4',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'T-Bar Row Machine'
        ]
    ],
    'legs' => [
        [
            'name' => 'Barbell Squats',
            'description' => 'The king of leg exercises. Targets quads, hamstrings, and glutes.',
            'video' => 'https://www.youtube.com/embed/aclHkVaku9U',
            'sets' => '4-5',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Barbell, Squat Rack'
        ],
        [
            'name' => 'Romanian Deadlifts',
            'description' => 'Focuses on the hamstrings and glutes. Great for posterior chain development.',
            'video' => 'https://www.youtube.com/embed/JCXUYuzwNrM',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Barbell'
        ],
        [
            'name' => 'Leg Press',
            'description' => 'Allows for heavy loading while being easier on the lower back.',
            'video' => 'https://www.youtube.com/embed/IZxyjW7MPJQ',
            'sets' => '3-4',
            'reps' => '10-12',
            'difficulty' => 'Beginner',
            'equipment' => 'Leg Press Machine'
        ],
        [
            'name' => 'Walking Lunges',
            'description' => 'Great for unilateral leg development and functional strength.',
            'video' => 'https://www.youtube.com/embed/QOVaHwm-Q6U',
            'sets' => '3',
            'reps' => '10-12 each leg',
            'difficulty' => 'Beginner',
            'equipment' => 'Dumbbells (optional)'
        ]
    ],
    'shoulders' => [
        [
            'name' => 'Overhead Press',
            'description' => 'A compound movement that targets the entire shoulder complex.',
            'video' => 'https://www.youtube.com/embed/2yjwXTZQDDI',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Barbell'
        ],
        [
            'name' => 'Lateral Raises',
            'description' => 'Isolates the lateral deltoids for wider shoulders.',
            'video' => 'https://www.youtube.com/embed/3VcKaXpzqRo',
            'sets' => '3',
            'reps' => '12-15',
            'difficulty' => 'Beginner',
            'equipment' => 'Dumbbells'
        ],
        [
            'name' => 'Face Pulls',
            'description' => 'Targets the rear deltoids and improves posture.',
            'video' => 'https://www.youtube.com/embed/rep-qVOkqgk',
            'sets' => '3',
            'reps' => '12-15',
            'difficulty' => 'Beginner',
            'equipment' => 'Cable Machine'
        ],
        [
            'name' => 'Arnold Press',
            'description' => 'A variation of the overhead press that targets all three deltoid heads.',
            'video' => 'https://www.youtube.com/embed/6Z15_WdXmVw',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Dumbbells'
        ]
    ],
    'arms' => [
        [
            'name' => 'Barbell Curls',
            'description' => 'A classic bicep exercise for overall arm development.',
            'video' => 'https://www.youtube.com/embed/LY1V6UbRHFM',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Beginner',
            'equipment' => 'Barbell'
        ],
        [
            'name' => 'Tricep Dips',
            'description' => 'Targets the triceps and chest. Can be done with bodyweight or added weight.',
            'video' => 'https://www.youtube.com/embed/6xguGSCX6oY',
            'sets' => '3',
            'reps' => '10-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'Dip Station'
        ],
        [
            'name' => 'Hammer Curls',
            'description' => 'Works the biceps and forearms. Great for overall arm development.',
            'video' => 'https://www.youtube.com/embed/zC3nLlEvin4',
            'sets' => '3',
            'reps' => '10-12',
            'difficulty' => 'Beginner',
            'equipment' => 'Dumbbells'
        ],
        [
            'name' => 'Skull Crushers',
            'description' => 'Excellent for tricep development and arm thickness.',
            'video' => 'https://www.youtube.com/embed/d_KZxkY_0cM',
            'sets' => '3-4',
            'reps' => '8-12',
            'difficulty' => 'Intermediate',
            'equipment' => 'EZ Bar'
        ]
    ],
    'core' => [
        [
            'name' => 'Plank',
            'description' => 'A fundamental core exercise that targets the entire abdominal region.',
            'video' => 'https://www.youtube.com/embed/pSHjTRCQxIw',
            'sets' => '3',
            'reps' => '30-60 seconds',
            'difficulty' => 'Beginner',
            'equipment' => 'None'
        ],
        [
            'name' => 'Russian Twists',
            'description' => 'Targets the obliques and improves rotational strength.',
            'video' => 'https://www.youtube.com/embed/wkD8rjk9uTg',
            'sets' => '3',
            'reps' => '15-20 each side',
            'difficulty' => 'Beginner',
            'equipment' => 'Medicine Ball (optional)'
        ],
        [
            'name' => 'Hanging Leg Raises',
            'description' => 'Advanced core exercise that targets the lower abs.',
            'video' => 'https://www.youtube.com/embed/l4kQWD9ZBig',
            'sets' => '3',
            'reps' => '8-12',
            'difficulty' => 'Advanced',
            'equipment' => 'Pull-up Bar'
        ],
        [
            'name' => 'Cable Woodchoppers',
            'description' => 'Great for core strength and rotational power.',
            'video' => 'https://www.youtube.com/embed/2UvjVqyqQqE',
            'sets' => '3',
            'reps' => '12-15 each side',
            'difficulty' => 'Intermediate',
            'equipment' => 'Cable Machine'
        ]
    ]
];

// Get exercises for the selected category
$categoryExercises = $exercises[$category] ?? $exercises['chest'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($category); ?> Exercises - FIT TRACK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .exercise-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .exercise-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        body{
            background-image: url('pexels-goumbik-669584.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header -->
    <header class="bg-white/0">
    <div class="max-w-7xl px-4 mx-auto">
        <div class="flex justify-between items-center h-16">
            <!-- Left Section -->
            <div class="flex items-center">
                <a href="workout.php" class="text-gray-700 hover:text-blue-500 mr-4">
                    <i class="fas fa-arrow-left"></i> 
                </a>
                <img src="cooltext479659028948576.png" alt="FIT TRACK" class="h-8 w-auto">
            </div>

            <!-- Right Section -->
            <div class="flex items-center ml-auto">
                <a href="dashboard.php" class="text-white rounded-lg bg-gray-900 px-4 py-2 hover:text-blue-500">
                    <i class="fas fa-home"></i> Dashboard
                </a>
            </div>
        </div>
    </div>
</header>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-8 text-center"><?php echo ucfirst($category); ?> Exercises</h1>
            
            <div class="grid grid-cols-1 gap-8">
                <?php foreach ($categoryExercises as $exercise): ?>
                <div class="exercise-card bg-gray-300 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-4"><?php echo $exercise['name']; ?></h2>
                                <p class="text-gray-900 font-bold mb-4"><?php echo $exercise['description']; ?></p>
                                
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="bg-blue-50 px-4 py-2 rounded-lg">
                                        <span class="text-sm font-medium text-blue-800">Sets: <?php echo $exercise['sets']; ?></span>
                        </div>
                                    <div class="bg-green-50 px-4 py-2 rounded-lg">
                                        <span class="text-sm font-medium text-green-800">Reps: <?php echo $exercise['reps']; ?></span>
                        </div>
                                    <div class="bg-purple-50 px-4 py-2 rounded-lg">
                                        <span class="text-sm font-medium text-purple-800">Difficulty: <?php echo $exercise['difficulty']; ?></span>
                        </div>
                                    <div class="bg-yellow-50 px-4 py-2 rounded-lg">
                                        <span class="text-sm font-medium text-yellow-800">Equipment: <?php echo $exercise['equipment']; ?></span>
                    </div>
                </div>

                                <div class="flex space-x-4">
                                    <a href="progress.php?exercise=<?php echo urlencode($exercise['name']); ?>" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-900 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-plus-circle mr-2"></i> Log This Exercise
                                    </a>
                                    <button onclick="toggleVideo('<?php echo $exercise['name']; ?>')" 
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="fas fa-play-circle mr-2"></i> Watch Tutorial
                                    </button>
                        </div>
                    </div>
                            <div class="video-container rounded-lg overflow-hidden hidden" id="video-<?php echo str_replace(' ', '-', $exercise['name']); ?>">
                                <iframe src="<?php echo $exercise['video']; ?>" 
                                        title="<?php echo $exercise['name']; ?> tutorial" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                </iframe>
                        </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                        </div>
                    </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-8">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <p class="text-gray-500 text-sm">© 2024 FIT TRACK. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-500 hover:text-gray-700">Privacy Policy</a>
                    <a href="#" class="text-gray-500 hover:text-gray-700">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleVideo(exerciseName) {
            const videoId = 'video-' + exerciseName.replace(/ /g, '-');
            const videoContainer = document.getElementById(videoId);
            videoContainer.classList.toggle('hidden');
        }
    </script>
</body>
</html>