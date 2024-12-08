<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <section class="min-h-screen flex bg-gray-200 text-black">
        <div class="px-6 py-16 w-full">
            @yield('content')
        </div>
    </section>
</body>

</html>
