<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'config.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_calorie'])) {
        $food_name = $_POST['food_name'];
        $calories = $_POST['calories'];
        $date = $_POST['date'];
        $meal_type = $_POST['meal_type'];
        
        $stmt = $pdo->prepare("INSERT INTO calorie_tracker (user_id, food_name, calories, date, meal_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $food_name, $calories, $date, $meal_type]);
    }
}

// Get user's calorie entries
$stmt = $pdo->prepare("SELECT * FROM calorie_tracker WHERE user_id = ? ORDER BY date DESC");
$stmt->execute([$_SESSION['user_id']]);
$entries = $stmt->fetchAll();

// Calculate total calories for today
$today = date('Y-m-d');
$stmt = $pdo->prepare("SELECT SUM(calories) as total FROM calorie_tracker WHERE user_id = ? AND date = ?");
$stmt->execute([$_SESSION['user_id'], $today]);
$today_total = $stmt->fetch()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calorie Tracker - FITRACK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .range-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            border-radius: 5px;
            background: #e5e7eb;
            outline: none;
        }

        .range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #22c55e;
            cursor: pointer;
            border: 4px solid white;
            box-shadow: 0 0 0 1px #22c55e;
        }

        .results-panel {
            background-color: #f0fdf4;
            border-radius: 1rem;
            padding: 2rem;
        }
    </style>
</head>
<body class="min-h-screen bg-white">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold text-gray-900 mb-12">Calorie Tracker</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Left Column - Input Form -->
            <div>
                <form method="POST" class="space-y-8">
                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Food Name</label>
                        <input type="text" name="food_name" required 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Calories</label>
                        <div class="space-y-2">
                            <input type="range" name="calories" min="0" max="2000" value="500" 
                                   class="range-slider" id="calorieSlider">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>0 kcal</span>
                                <output id="calorieValue" class="font-medium">500 kcal</output>
                                <span>2000 kcal</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Meal Type</label>
                        <select name="meal_type" required 
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                            <option value="Breakfast">Breakfast</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                            <option value="Snack">Snack</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Date</label>
                        <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>

                    <button type="submit" name="add_calorie" 
                            class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300">
                        Add Entry
                    </button>
                </form>
            </div>

            <!-- Right Column - Results Panel -->
            <div>
                <div class="results-panel">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Today's Summary</h2>
                    <p class="text-gray-600 mb-6">Track your daily calorie intake</p>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-4xl font-bold text-gray-900 mb-1"><?php echo $today_total; ?></h3>
                            <p class="text-gray-600">Total Calories Today</p>
                        </div>

                        <div class="pt-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Entries</h3>
                            <div class="space-y-3">
                                <?php 
                                $count = 0;
                                foreach ($entries as $entry): 
                                    if ($count < 3):  // Show only last 3 entries
                                ?>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600"><?php echo htmlspecialchars($entry['food_name']); ?></span>
                                    <span class="font-medium text-gray-900"><?php echo $entry['calories']; ?> kcal</span>
                                </div>
                                <?php 
                                    endif;
                                    $count++;
                                endforeach; 
                                ?>
                            </div>
                        </div>

                        <a href="#" class="block text-center mt-6">
                            <button class="bg-green-600 text-white py-3 px-6 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300">
                                View All Entries
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update calorie value display
        const calorieSlider = document.getElementById('calorieSlider');
        const calorieValue = document.getElementById('calorieValue');
        
        calorieSlider.addEventListener('input', function() {
            calorieValue.textContent = this.value + ' kcal';
        });
    </script>
</body>
</html>