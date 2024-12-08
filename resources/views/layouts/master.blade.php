<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <section class="min-h-screen flex bg-gray-800 text-white">
        @include('components.sidebar')
        <div class="px-6 py-8 w-full">
            @yield('content')
        </div>
    </section>
</body>

</html>
