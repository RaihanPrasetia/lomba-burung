<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start"
    navbar-main navbar-scroll="true">
    <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
        <nav>
            <!-- Breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                <li class="text-sm leading-normal">
                    <a class="opacity-50 text-slate-700" href="{{ url('/') }}">Home</a>
                </li>
                @php
                    $segments = request()->segments();
                    $url = '';
                @endphp
                @foreach ($segments as $index => $segment)
                    @php
                        $url .= '/' . $segment;
                    @endphp
                    <li
                        class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']">
                        @if ($index < count($segments) - 1)
                            <a class="opacity-50 text-slate-700" href="{{ url($url) }}">{{ ucfirst($segment) }}</a>
                        @else
                            <span aria-current="page">{{ ucfirst($segment) }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
            <h6 class="mb-0 font-bold capitalize">{{ ucfirst(last(request()->segments()) ?? 'Dashboard') }}</h6>
        </nav>

        <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <div class="flex items-center md:ml-auto md:pr-4">
            </div>
            <div class="flex items-center">
                <a href="#"
                    class="text-white bg-gradient-to-br from-pink-500 to-voilet-500 hover:scale-[1.02] shadow-md shadow-gray-300 transition-transform font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3">
                    <svg class="mr-2 -ml-1 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Log Out
                </a>
            </div>
        </div>
    </div>
</nav>
