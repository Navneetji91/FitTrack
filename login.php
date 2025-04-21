<?php
require_once 'config.php';

session_start();

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Validate form data
    if (empty($email) || empty($password)) {
        $error = "All fields are required";
    } else {
        try {
            // Check if user exists
            $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                
                // Redirect to dashboard
                header('Location: dashboard.php');
                exit();
            } else {
                $error = "Invalid email or password";
            }
        } catch(PDOException $e) {
            $error = "Login failed. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FIT TRACK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <!-- Background Video -->
    <video autoplay muted loop class="absolute top-0 left-0 w-full h-full object-cover z-[-2]">
        <source src="5756199-hd_1920_816_24fps.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Fixed header -->
    <div class="w-full py-4 px-5 bg-white/0 text-white font-bold fixed top-0 flex items-center justify-between z-50">
    <!-- Logo on the left -->
    <div class="flex items-center">
        <img class="h-10 w-auto" src="cooltext479659028948576.png" alt="Logo">
    </div>

    <!-- HOME button on the right -->
    <div>
        <a href="home.php" class="rounded-lg bg-white text-black px-4 py-2 hover:bg-gray-200 transition">HOME</a>
    </div>
</div>

    
    <div class="w-full max-w-md">
        <div class="bg-white/0 rounded-lg text-center py-5 overflow-hidden">
            <h1 class="text-3xl font-extrabold font-awesome text-white">Welcome Back</h1>
            <p class="text-white font-bold">Sign in to your account</p>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" class="p-6 space-y-6">
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm text-white font-medium text-left mb-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                required
                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                            >
                        </div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-white text-left mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="" 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                required
                            >
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="remember" 
                                name="remember" 
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                            >
                            <label for="remember" class="ml-2 block text-sm text-white">
                                Remember me
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="forgot-password.php" class="font-medium text-blue-600 hover:text-red-500">
                                Forgot password?
                            </a>
                        </div>
                    </div>
                </div>
                
                <button 
                    type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-900 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:bg-red-500"
                >
                    Sign In
                </button>
            </form>
            
            <p class="text-sm text-white text-center">
                Don't have an account? 
                <a href="signup.php" class="font-medium text-blue-600 hover:text-red-500">Sign up</a>
            </p>
        </div>
    </div>
</body>
</html>
