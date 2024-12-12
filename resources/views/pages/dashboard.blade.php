@extends('layouts.master')

@section('content')
    <section>
        <!-- cards -->
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">
                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Today's Money</p>
                                        <h5 class="mb-0 font-bold">
                                            $53,000
                                            <span class="text-sm leading-normal font-weight-bolder text-lime-500">+55%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">Today's Users</p>
                                        <h5 class="mb-0 font-bold">
                                            2,300
                                            <span class="text-sm leading-normal font-weight-bolder text-lime-500">+3%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card3 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none w-2/3 max-w-full px-3">
                                    <div>
                                        <p class="mb-0 font-sans text-sm font-semibold leading-normal">New Clients</p>
                                        <h5 class="mb-0 font-bold">
                                            +3,462
                                            <span class="text-sm leading-normal text-red-600 font-weight-bolder">-2%</span>
                                        </h5>
                                    </div>
                                </div>
                                <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mt-6 md:w-7/12 md:flex-none">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                            <h6 class="mb-0">Nama Event</h6>
                        </div>
                        <div class="flex-auto p-4 pt-6">
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li class="relative flex p-6 mb-2 border-0 rounded-t-inherit rounded-xl bg-gray-50">
                                    <div class="flex flex-col">
                                        <h6 class="mb-4 leading-normal text-sm">Class A</h6>
                                        <span class="mb-2 leading-tight text-xs">Nama Juri: <span
                                                class="font-semibold text-slate-700 sm:ml-2">Viking Burrito</span></span>
                                        <span class="mb-2 leading-tight text-xs">Email Address: <span
                                                class="font-semibold text-slate-700 sm:ml-2">oliver@burrito.com</span></span>
                                        <span class="leading-tight text-xs">VAT Number: <span
                                                class="font-semibold text-slate-700 sm:ml-2">FRB1235476</span></span>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <a class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text"
                                            href="javascript:;"><i
                                                class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                                        <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700"
                                            href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700"
                                                aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                                <li class="relative flex p-6 mt-4 mb-2 border-0 rounded-xl bg-gray-50">
                                    <div class="flex flex-col">
                                        <h6 class="mb-4 leading-normal text-sm">Lucas Harper</h6>
                                        <span class="mb-2 leading-tight text-xs">Company Name: <span
                                                class="font-semibold text-slate-700 sm:ml-2">Stone Tech Zone</span></span>
                                        <span class="mb-2 leading-tight text-xs">Email Address: <span
                                                class="font-semibold text-slate-700 sm:ml-2">lucas@stone-tech.com</span></span>
                                        <span class="leading-tight text-xs">VAT Number: <span
                                                class="font-semibold text-slate-700 sm:ml-2">FRB1235476</span></span>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <a class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text"
                                            href="javascript:;"><i
                                                class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                                        <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700"
                                            href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700"
                                                aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                                <li class="relative flex p-6 mt-4 mb-2 border-0 rounded-b-inherit rounded-xl bg-gray-50">
                                    <div class="flex flex-col">
                                        <h6 class="mb-4 leading-normal text-sm">Ethan James</h6>
                                        <span class="mb-2 leading-tight text-xs">Company Name: <span
                                                class="font-semibold text-slate-700 sm:ml-2">Fiber Notion</span></span>
                                        <span class="mb-2 leading-tight text-xs">Email Address: <span
                                                class="font-semibold text-slate-700 sm:ml-2">ethan@fiber.com</span></span>
                                        <span class="leading-tight text-xs">VAT Number: <span
                                                class="font-semibold text-slate-700 sm:ml-2">FRB1235476</span></span>
                                    </div>
                                    <div class="ml-auto text-right">
                                        <a class="relative z-10 inline-block px-4 py-3 mb-0 font-bold text-center text-transparent uppercase align-middle transition-all border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 bg-gradient-to-tl from-red-600 to-rose-400 hover:scale-102 active:opacity-85 bg-x-25 bg-clip-text"
                                            href="javascript:;"><i
                                                class="mr-2 far fa-trash-alt bg-150 bg-gradient-to-tl from-red-600 to-rose-400 bg-x-25 bg-clip-text"></i>Delete</a>
                                        <a class="inline-block px-4 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 bg-x-25 text-slate-700"
                                            href="javascript:;"><i class="mr-2 fas fa-pencil-alt text-slate-700"
                                                aria-hidden="true"></i>Edit</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 mt-6 md:w-5/12 md:flex-none">
                    <div
                        class="relative flex flex-col h-full min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-6 px-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
                            <div class="flex flex-wrap -mx-3">
                                <div class="max-w-full px-3 md:w-1/2 md:flex-none">
                                    <h6 class="mb-0">Daftar Peringkat</h6>
                                </div>
                                <div class="flex items-center justify-end max-w-full px-3 md:w-1/2 md:flex-none">
                                    <i class="mr-2 far fa-calendar-alt"></i>
                                    <small>Event 1</small>
                                </div>
                            </div>
                        </div>
                        <div class="flex-auto p-4 pt-6">
                            <h6 class="mb-4 font-bold leading-tight uppercase text-xs text-slate-500">Class A</h6>
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-red-600 border-transparent bg-transparent text-center align-middle font-bold uppercase text-red-600 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-down text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 5</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #1</p>
                                    </div>
                                </li>
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 3</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #2</p>
                                    </div>
                                </li>
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 rounded-b-inherit text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 15</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #3</p>
                                    </div>
                                </li>
                            </ul>
                            <h6 class="my-4 font-bold leading-tight uppercase text-xs text-slate-500">Class B</h6>
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 18</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #1</p>
                                    </div>
                                </li>
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700"> No Gantang 10</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #2</p>
                                    </div>
                                </li>
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 5</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 items-center inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #3</p>
                                    </div>
                                </li>
                            </ul>
                            <h6 class="my-4 font-bold leading-tight uppercase text-xs text-slate-500">Class C</h6>
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 18</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #1</p>
                                    </div>
                                </li>
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700"> No Gantang 10</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #2</p>
                                    </div>
                                </li>
                                <li
                                    class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 border-t-0 text-inherit rounded-xl">
                                    <div class="flex items-center">
                                        <button
                                            class="leading-pro ease-soft-in text-xs bg-150 w-6.35 h-6.35 p-1.2 rounded-3.5xl tracking-tight-soft bg-x-25 mr-4 mb-0 flex cursor-pointer items-center justify-center border border-solid border-lime-500 border-transparent bg-transparent text-center align-middle font-bold uppercase text-lime-500 transition-all hover:opacity-75"><i
                                                class="fas fa-arrow-up text-3xs"></i></button>
                                        <div class="flex flex-col">
                                            <h6 class="mb-1 leading-normal text-sm text-slate-700">No Gantang 5</h6>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center justify-center">
                                        <p
                                            class="relative z-10 items-center inline-block m-0 font-semibold leading-normal text-transparent bg-gradient-to-tl from-green-600 to-lime-400 text-sm bg-clip-text">
                                            #3</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
