<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'microfinance management system') }}</title>

        @livewireStyles


        <link rel="stylesheet" href="{{ asset('build/assets/app-0b078e59.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('assets/css/flowbite.min.css') }}" type="text/css">


        <style>

            @import url(//fonts.googleapis.com/css?family=Lato:300:400);

            /*.bodyGradient {*/
            /*    position:relative;*/
            /*    text-align:center;*/
            /*    background: linear-gradient(to bottom left, #2D3A89 0%, rgba(84, 58, 183, 1) 50%, rgba(0, 172, 193, 1) 100%);*/
            /*    color:white;*/
            /*}*/

            .waves {
                position:relative;
                width: 100%;
                height:15vh;
                margin-bottom:-7px; /*Fix for safari gap*/
                min-height:100px;
                max-height:150px;
            }





            /* Animation */

            .parallax > use {
                animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
            }
            .parallax > use:nth-child(1) {
                animation-delay: -2s;
                animation-duration: 7s;
            }
            .parallax > use:nth-child(2) {
                animation-delay: -3s;
                animation-duration: 10s;
            }
            .parallax > use:nth-child(3) {
                animation-delay: -4s;
                animation-duration: 13s;
            }
            .parallax > use:nth-child(4) {
                animation-delay: -5s;
                animation-duration: 20s;
            }
            @keyframes move-forever {
                0% {
                    transform: translate3d(-90px,0,0);
                }
                100% {
                    transform: translate3d(85px,0,0);
                }
            }
            /*Shrinking for mobile*/
            @media (max-width: 768px) {
                .waves {
                    height:40px;
                    min-height:40px;
                }
                .content {
                    height:30vh;
                }
                h1 {
                    font-size:24px;
                }
            }

            .text-color-primary{
                text-decoration-color:#c40f11 ;
            }

        </style>
    </head>
    <body class="font-inter bg-white-50 opacity-0.07 antialiased text-slate-600 h-full h-100">

        <main class="">

            <div class="relative flex justify-top ">

                <!-- Content -->
                <div class="w-full md:w-1/2 ">

{{--                    <div class="min-h-screen h-full flex flex-col after:flex-1 justify-end">--}}

                        <!-- Header -->
                        <div class="flex-1 justify-center items-center flex mt-0">
                            <div class="flex items-start justify-between h-25 px-4 sm:px-6 lg:px-8">
                                <!-- Logo -->
                                <a class="block mt-2 flex items-center" href="{{ route('CyberPoint-Pro') }}">
                                    <img class="mt-1" src="{{ asset('/creditInfoLogor.png') }}"
                                         height="200" width="200" alt="Authentication decoration" />
                                </a>
                            </div>
                        </div>

{{--                    </div>--}}
                </div>
            </div>


            <div class="relative top-5 left-0 right-0 bottom-0 flex justify-center items-center rounded-lg" >
                <div id="xx" class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-50  bg-gray-50 transition-transform transform hover:shadow-xl hover:scale-105    max-w-sm px-4 py-8 bg-white-900 self-center rounded-xl shadow-md shadow-lg " style="margin: 0 auto; width: 400px">
                    <div class="text-center w-full p-2">
                    <span class="mt-4 mb-4 font-bold text-2xl  text-color-primary  mb-4 self-center text-center " style="color:#c40f11 ">MICROFINANCE MANAGEMENT SYSTEM</span>
                    </div>
                    <div class="mt-0"> </div>
                    {{ $slot }}
                </div>

{{--                <div class="fixed left-0 right-0 bottom-0">--}}
{{--                    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">--}}
{{--                        <defs>--}}
{{--                            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />--}}
{{--                        </defs>--}}
{{--                        <g class="parallax">--}}
{{--                            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255, 0, 0, 0.7)" />--}}
{{--                            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255, 0, 0, 1)" >  </use>--}}
{{--                            <use xlink:href="#gentle-wave" x="48" y="7" fill=" rgba(0, 0, 0, 0.7)" />--}}
{{--                            <use xlink:href="#gentle-wave" x="48" y="9" fill="rgba(255, 0, 0, 0.2)" />--}}
{{--                        </g>--}}
{{--                    </svg>--}}
{{--                </div>--}}
            </div>


            <div class="relative flex justify-center ">

                <!-- Content -->

                    {{--                    <div class="min-h-screen h-full flex flex-col after:flex-1 justify-end">--}}

                    <!-- Header -->
                    <div class="flex-1 justify-center items-center flex mt-10">
                        <div class="flex items-start justify-between h-25 px-4 sm:px-6 lg:px-8">


                                    <p class="text-sm">  Powered By <a href="https://isalegroup.co.tz/" class="text-red-500">Isale Investment Iimited  </a> © 2024 </p>

                        </div>
                    </div>

                    {{--                    </div>--}}
            </div>

        </main>
        @livewireScripts
    </body>
</html>
