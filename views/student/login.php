<?php

if (
	session_status() == PHP_SESSION_NONE
) {
	session_start();
}
// Access configuration values from the session
if (isset($_SESSION['appName']) && isset($_SESSION['appUrl'])) {
	$appName = $_SESSION['appName'];
	$appUrl = $_SESSION['appUrl'];
} else {
	// Handle the case where session values are not set
	// You may want to redirect to the index page or set default values
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="icon" type="image/svg" href="asset/assets/favicon.svg" />
	<link rel="stylesheet" href="asset/input.css">
	<title>Student Login</title>
</head>

<body>
	<div class="container flex h-screen">
		<div class="hidden lg:block lg:w-1/2 h-full bg- fixed">
			<img src="asset/assets/left-image.png" alt="Left-Image" class="w-full h-full object-cover">
		</div>
		<div class="w-full flex flex-col justify-start lg:ml-auto md:px-24 h-full lg:w-1/2 py-0 md:justify-center md:py-4">
			<div class="details p-6 md:p-0">
				<img src="asset/assets/Logo1.svg" alt="Logo" class="mt-4 mb-8 block lg:hidden">
				<h1 class="text-[34.9px] font-semibold tracking-tight mb-2 text-3xl text-center md:text-left mt-36 md:mt-0">Welcome Back!</h1>
				<p class="text-base text-[#808080] text-center md:text-left">
					New here?
					<a href="signup.html" class="text-[#6936f5] font-semibold">
						Create an account
					</a>
				</p>
				<?php
				$errors = isset($_SESSION['login_errors']) ? $_SESSION['login_errors'] : [];
				unset($_SESSION['login_errors']);
				?>
				<?php if (!empty($errors)) : ?>
					<div class="text-red-500 bg-red-100 p-3 mb-4 border border-red-400 rounded">
						<?php foreach ($errors as $error) : ?>
							<p><?php echo $error; ?></p>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<!-- Form -->
				<form method="post" action="<?php echo $appUrl . '/validate'; ?>" class="mt-3 md:mt-6">
					<label for="email" class="block mt-4 mb-2 font-semibold text-black text-base">Email</label>
					<input type="email" id="email" name="email" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#6936f5] focus-border" placeholder="Enter your email">

					<label for="password" class="block mt-4 mb-2 font-semibold text-black text-base">Password</label>
					<input type="password" id="password" name="password" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#6936f5] focus-border" placeholder="Min. of 8 characters">

					<button type="submit" class="my-5 block text-center bg-[#6936f5] linear rounded-lg p-3 text-base text-white font-medium">Log in</button>

					<p class="text-center text-base">Don't have an account yet?
						<a href="<?php echo $appUrl . '/signup'; ?>" class="text-[#6936f5] font-semibold">
							Sign up
						</a>
					</p>
				</form>

			</div>
		</div>
	</div>
</body>

</html>