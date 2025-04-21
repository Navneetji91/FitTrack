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

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $height = floatval($_POST['height']);
    $weight = floatval($_POST['weight']);
    $activity_level = $_POST['activity_level'];
    $goal = $_POST['goal'];

    if ($age > 0 && $height > 0 && $weight > 0) {
        // Calculate BMR (Basal Metabolic Rate)
        if ($gender == 'male') {
            $bmr = 88.362 + (13.397 * $weight) + (4.799 * $height) - (5.677 * $age);
        } else {
            $bmr = 447.593 + (9.247 * $weight) + (3.098 * $height) - (4.330 * $age);
        }

        // Apply activity level multiplier
        $activity_multipliers = [
            'sedentary' => 1.2,
            'light' => 1.375,
            'moderate' => 1.55,
            'active' => 1.725,
            'very_active' => 1.9
        ];

        $tdee = $bmr * $activity_multipliers[$activity_level];

        // Adjust for goal
        $goal_adjustments = [
            'maintain' => 0,
            'lose' => -500,
            'gain' => 500
        ];

        $result = [
            'bmr' => round($bmr),
            'tdee' => round($tdee),
            'goal_calories' => round($tdee + $goal_adjustments[$goal])
        ];
    } else {
        $error = "Please enter valid values for all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Calorie Calculator</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .slider {
      -webkit-appearance: none;
      width: 100%;
      height: 6px;
      background: #e5e7eb;
      outline: none;
      border-radius: 9999px;
    }
    .slider::-webkit-slider-thumb {
      -webkit-appearance: none;
      appearance: none;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: white;
      border: 2px solid #22c55e;
      cursor: pointer;
    }
    .slider::-moz-range-thumb {
      width: 20px;
      height: 20px;
      border-radius: 50%;
      background: white;
      border: 2px solid #22c55e;
      cursor: pointer;
    }
  </style>
</head>
<body class="bg-white text-gray-800 font-sans">
  <div class="max-w-6xl mx-auto py-20 px-4 flex flex-col md:flex-row gap-8">
    <div class="flex-1">
      <h1 class="text-4xl font-bold mb-10">Calorie Calculator</h1>

      <div class="mb-8">
        <label class="block font-semibold mb-2">Age</label>
        <input type="range" id="ageSlider" min="10" max="100" value="25" class="slider bg-green-600">
        <div class="mt-2 flex justify-between text-sm text-gray-500">
          <span>10</span>
          <span>100</span>
        </div>
        <div class="mt-2">
          <input id="ageInput" value="25 years" readonly class="border rounded-md px-4 py-2" />
        </div>
        <p class="text-sm text-gray-500 mt-1">Your age in years</p>
      </div>

      <div class="mb-8">
        <label class="block font-semibold mb-2">Weight</label>
        <input type="range" id="weightSlider" min="30" max="200" value="70" class="slider bg-green-600">
        <div class="mt-2 flex justify-between text-sm text-gray-500">
          <span>30 kg</span>
          <span>200 kg</span>
        </div>
        <div class="mt-2">
          <input id="weightInput" value="70 kg" readonly class="border rounded-md px-4 py-2" />
        </div>
        <p class="text-sm text-gray-500 mt-1">Your weight in kilograms</p>
      </div>

      <div class="mb-8">
        <label class="block font-semibold mb-2">Height</label>
        <input type="range" id="heightSlider" min="100" max="250" value="170" class="slider bg-green-600">
        <div class="mt-2 flex justify-between text-sm text-gray-500">
          <span>100 cm</span>
          <span>250 cm</span>
        </div>
        <div class="mt-2">
          <input id="heightInput" value="170 cm" readonly class="border rounded-md px-4 py-2" />
        </div>
        <p class="text-sm text-gray-500 mt-1">Your height in centimeters</p>
      </div>
    </div>

    <div class="flex-1 bg-green-50 rounded-xl p-8">
      <div>
        <h2 class="text-xl font-bold text-gray-700">Estimated Calories</h2>
        <p id="calorieResult" class="text-4xl font-bold mt-2 mb-2">0 kcal/day</p>
        <p class="text-sm text-gray-600">Daily Maintenance Calories</p>

        <div class="mt-6">
          <h3 class="text-xl font-bold text-gray-800">Understand Your Needs</h3>
          <p class="text-sm text-gray-600 mt-2">
            Your estimated calorie intake helps you understand how much energy your body needs to function properly.
            Consult a healthcare professional for tailored guidance.
          </p>
        </div>

        <button class="mt-6 bg-green-600 text-white font-bold px-6 py-3 rounded-md hover:bg-green-700">
          Get Health Tips
        </button>
      </div>
    </div>
  </div>

  <script>
    const ageSlider = document.getElementById("ageSlider");
    const weightSlider = document.getElementById("weightSlider");
    const heightSlider = document.getElementById("heightSlider");
    const ageInput = document.getElementById("ageInput");
    const weightInput = document.getElementById("weightInput");
    const heightInput = document.getElementById("heightInput");
    const calorieResult = document.getElementById("calorieResult");

    function updateCalories() {
      const age = parseFloat(ageSlider.value);
      const weight = parseFloat(weightSlider.value);
      const height = parseFloat(heightSlider.value);

      // Mifflin-St Jeor Equation for BMR (basic example assuming male)
      const bmr = 10 * weight + 6.25 * height - 5 * age + 5;
      calorieResult.textContent = `${Math.round(bmr)} kcal/day`;

      ageInput.value = `${age} years`;
      weightInput.value = `${weight} kg`;
      heightInput.value = `${height} cm`;
    }

    ageSlider.addEventListener("input", updateCalories);
    weightSlider.addEventListener("input", updateCalories);
    heightSlider.addEventListener("input", updateCalories);

    updateCalories();
  </script>
</body>
</html>

