<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - FakeBook</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navigation Bar -->
    <nav class="bg-blue-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-semibold">Fakebook</a>
            <ul class="flex space-x-6">
                <li><a href="#" class="text-white hover:text-gray-200">Home</a></li>
                <li><a href="#" class="text-white hover:text-gray-200">Profile</a></li>
                <li><a href="#" class="text-white hover:text-gray-200">Friends</a></li>
                <li><a href="logout.php" class="text-white hover:text-gray-200">Logout</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Post 1 -->
            <div class="bg-white rounded-lg p-4 shadow">
                <h2 class="text-lg font-semibold">Post Title 1</h2>
                <p class="text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <div class="mt-4">
                    <button class="text-blue-500 hover:underline">Read More</button>
                </div>
            </div>

            <!-- Post 2 -->
            <div class="bg-white rounded-lg p-4 shadow">
                <h2 class="text-lg font-semibold">Post Title 2</h2>
                <p class="text-gray-600">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <div class="mt-4">
                    <button class="text-blue-500 hover:underline">Read More</button>
                </div>
            </div>

            <!-- Post 3 -->
            <div class="bg-white rounded-lg p-4 shadow">
                <h2 class="text-lg font-semibold">Post Title 3</h2>
                <p class="text-gray-600">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>
                <div class="mt-4">
                    <button class="text-blue-500 hover:underline">Read More</button>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
