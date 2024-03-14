<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.tailwindcss.com"></script>
	<link rel="icon" type="image/svg" href="asset/assets/favicon.svg" />
	<link rel="stylesheet" href="asset/input.css">
	<title>Admin Login</title>
</head>

<body>
	<div class="container flex h-screen">
		<div class="hidden lg:block lg:w-1/2 h-full bg- fixed">
			<img src="asset/assets/left-image.png" alt="Left-Image" class="w-full h-full object-cover">
		</div>
		<div class="w-full flex flex-col justify-start lg:ml-auto md:px-24 h-full lg:w-1/2 py-0 md:justify-center md:py-4">
			<div class="details p-6 md:p-0">
				<img src="asset/assets/admin-logo.svg" alt="Logo" class="mt-4 mb-8 block lg:hidden">
				<h1 class="text-[34.9px] font-semibold tracking-tight mb-2 text-3xl text-center md:text-left mt-36 md:mt-0">Admin Login</h1>
				<p class="text-base text-[#808080] text-center md:text-left">Enter admin credentials to access dashboard.</p>
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
				<form method="post" action="/matricno-generator/admin-login/authenticate">
					<div>
						<label for="email" class="block mt-4 mb-2 font-semibold text-base">Email</label>
						<input type="email" name="email" id="email" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Enter Email">

						<label for="password" class="block mt-4 mb-2 font-semibold text-base">Password</label>
						<input type="password" name="password" id="password" class="border text-sm rounded-md block w-full p-2.5 py-3 focus:border-[#0D0D0D] admin-focus-border" placeholder="Min. of 8 characters">

						<button type="submit" class="my-5 block text-center bg-[#0D0D0D] linear rounded-lg p-3 text-base text-white font-medium">Log in</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</body>

</html>