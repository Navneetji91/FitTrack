<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BMI Calculator</title>
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
      <h1 class="text-4xl font-bold mb-10">BMI Calculator</h1>

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
        <h2 class="text-xl font-bold text-gray-700">BMI</h2>
        <p id="bmiResult" class="text-4xl font-bold mt-2 mb-2">24.22 kg/m²</p>
        <p class="text-sm text-gray-600">Body Mass Index</p>

        <div class="mt-4">
          <h3 class="text-lg font-semibold text-gray-700">BMI Category</h3>
          <p id="bmiCategory" class="text-md text-gray-800 font-medium mt-1">Normal weight</p>
        </div>

        <div class="mt-6">
          <h3 class="text-xl font-bold text-gray-800">Understand Your Health Better</h3>
          <p class="text-sm text-gray-600 mt-2">
            Your BMI result can help you understand your health better. Discuss your BMI with a
            healthcare provider for personalized advice.
          </p>
        </div>

        <button class="mt-6 bg-green-600 text-white font-bold px-6 py-3 rounded-md hover:bg-green-700">
          Get Health Tips
        </button>
      </div>
    </div>
  </div>

  <script>
    const weightSlider = document.getElementById("weightSlider");
    const heightSlider = document.getElementById("heightSlider");
    const weightInput = document.getElementById("weightInput");
    const heightInput = document.getElementById("heightInput");
    const bmiResult = document.getElementById("bmiResult");
    const bmiCategory = document.getElementById("bmiCategory");

    function updateBMI() {
      const weight = parseFloat(weightSlider.value);
      const height = parseFloat(heightSlider.value) / 100;
      const bmi = weight / (height * height);

      bmiResult.textContent = `${bmi.toFixed(2)} kg/m²`;
      weightInput.value = `${weight} kg`;
      heightInput.value = `${heightSlider.value} cm`;

      let category = "";
      if (bmi < 18.5) {
        category = "Underweight";
      } else if (bmi >= 18.5 && bmi < 24.9) {
        category = "Normal weight";
      } else if (bmi >= 25 && bmi < 29.9) {
        category = "Overweight";
      } else {
        category = "Obese";
      }

      bmiCategory.textContent = category;
    }

    weightSlider.addEventListener("input", updateBMI);
    heightSlider.addEventListener("input", updateBMI);

    updateBMI();
  </script>
</body>
</html>
