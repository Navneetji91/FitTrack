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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exercise_name = $_POST['exercise_name'];
    $sets = intval($_POST['sets']);
    $reps = intval($_POST['reps']);
    $weight = floatval($_POST['weight']);
    $date = date('Y-m-d');

    if ($exercise_name && $sets > 0 && $reps > 0) {
        $stmt = $pdo->prepare("INSERT INTO exercises (user_id, exercise_name, sets, reps, weight, date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $exercise_name, $sets, $reps, $weight, $date]);
    }
}

// Get exercise data for charts
$stmt = $pdo->prepare("
    SELECT 
        exercise_name,
        date,
        weight,
        sets,
        reps
    FROM exercises 
    WHERE user_id = ? 
    ORDER BY date ASC
");
$stmt->execute([$_SESSION['user_id']]);
$exercises = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Organize data for charts
$exercise_data = [];
foreach ($exercises as $exercise) {
    $name = trim($exercise['exercise_name']);
    if (!isset($exercise_data[$name])) {
        $exercise_data[$name] = [
            'labels' => [],
            'weights' => [],
            'volumes' => []
        ];
    }
    $exercise_data[$name]['labels'][] = date('M d', strtotime($exercise['date']));
    $exercise_data[$name]['weights'][] = floatval($exercise['weight']);
    $exercise_data[$name]['volumes'][] = intval($exercise['sets'] * $exercise['reps']);
}

// Get recent exercises for the panel
$stmt = $pdo->prepare("SELECT * FROM exercises WHERE user_id = ? ORDER BY date DESC LIMIT 5");
$stmt->execute([$_SESSION['user_id']]);
$recent_exercises = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Tracking - FIT TRACK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/luxon"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .range-slider {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            border-radius: 5px;
            background: #e5e7eb;
            outline: none;
            margin: 10px 0;
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

        .chart-container {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }
    </style>
</head>
<body class="min-h-screen bg-white">
    <!-- Main heading centered at top -->
    <div class="text-center mt-8" data-aos="fade-down">
        <h1 class="text-6xl font-bold text-black">Progress Tracker</h1>
    </div>

    <div class="max-w-4xl mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Left Column - Input Form -->
            <div>
                <form method="POST" class="space-y-8">
                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Exercise Name</label>
                        <input type="text" name="exercise_name" required 
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Sets</label>
                        <div class="space-y-2">
                            <input type="range" name="sets" min="1" max="10" value="3" 
                                   class="range-slider" id="setsSlider">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>1 set</span>
                                <output id="setsValue" class="font-medium">3 sets</output>
                                <span>10 sets</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Reps</label>
                        <div class="space-y-2">
                            <input type="range" name="reps" min="1" max="30" value="10" 
                                   class="range-slider" id="repsSlider">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>1 rep</span>
                                <output id="repsValue" class="font-medium">10 reps</output>
                                <span>30 reps</span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="text-xl font-medium text-gray-900 mb-2 block">Weight (kg)</label>
                        <div class="space-y-2">
                            <input type="range" name="weight" min="0" max="200" value="20" step="0.5"
                                   class="range-slider" id="weightSlider">
                            <div class="flex justify-between text-sm text-gray-600">
                                <span>0 kg</span>
                                <output id="weightValue" class="font-medium">20 kg</output>
                                <span>200 kg</span>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-green-600 text-white py-3 px-4 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300">
                        Log Exercise
                    </button>
                </form>
            </div>

            <!-- Right Column - Results Panel -->
            <div>
                <div class="results-panel">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Your Progress</h2>
                    <p class="text-gray-600 mb-6">Track your fitness journey</p>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Activities</h3>
                            <div class="space-y-3">
                                <?php foreach ($recent_exercises as $exercise): ?>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600"><?php echo htmlspecialchars($exercise['exercise_name']); ?></span>
                                    <span class="font-medium text-gray-900">
                                        <?php echo $exercise['sets']; ?> sets × <?php echo $exercise['reps']; ?> reps @ <?php echo $exercise['weight']; ?>kg
                                    </span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <a href="#" class="block text-center mt-6">
                            <button class="bg-green-600 text-white py-3 px-6 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-300">
                                View Full History
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="mt-12">
            <div class="text-center mb-8">
                <h2 class="text-6xl font-bold text-black">Progress Charts</h2>
            </div>
            <?php if (empty($exercise_data)): ?>
                <p class="text-gray-500 text-center">No exercise data available yet. Start logging your workouts!</p>
            <?php else: ?>
                <?php foreach ($exercise_data as $name => $data): ?>
                    <div class="chart-container">
                        <h3 class="text-xl font-bold text-gray-900 mb-4"><?php echo htmlspecialchars($name); ?></h3>
                        <canvas id="chart_<?php echo md5($name); ?>"></canvas>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Update slider values display
        const sliders = {
            'sets': { slider: document.getElementById('setsSlider'), output: document.getElementById('setsValue'), suffix: ' sets' },
            'reps': { slider: document.getElementById('repsSlider'), output: document.getElementById('repsValue'), suffix: ' reps' },
            'weight': { slider: document.getElementById('weightSlider'), output: document.getElementById('weightValue'), suffix: ' kg' }
        };

        Object.entries(sliders).forEach(([key, {slider, output, suffix}]) => {
            slider.addEventListener('input', function() {
                output.textContent = this.value + suffix;
            });
        });

        // Initialize charts
        <?php foreach ($exercise_data as $name => $data): ?>
        (function() {
            const ctx = document.getElementById('chart_<?php echo md5($name); ?>');
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($data['labels']); ?>,
                    datasets: [{
                        label: 'Weight (kg)',
                        data: <?php echo json_encode($data['weights']); ?>,
                        borderColor: '#22c55e',
                        backgroundColor: '#22c55e20',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })();
        <?php endforeach; ?>
    </script>
</body>
</html>
