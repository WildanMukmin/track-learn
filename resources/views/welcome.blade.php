<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: Figtree, sans-serif;
            font-feature-settings: normal
        }

        body {
            margin: 0;
            line-height: inherit
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        b,
        strong {
            font-weight: bolder
        }

        code,
        kbd,
        pre,
        samp {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em
        }

        small {
            font-size: 80%
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        sub {
            bottom: -.25em
        }

        sup {
            top: -.5em
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0
        }

        button,
        select {
            text-transform: none
        }

        [type=button],
        [type=reset],
        [type=submit],
        button {
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none
        }

        :-moz-focusring {
            outline: auto
        }

        :-moz-ui-invalid {
            box-shadow: none
        }

        progress {
            vertical-align: baseline
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto
        }

        [type=search] {
            -webkit-appearance: textfield;
            outline-offset: -2px
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit
        }

        summary {
            display: list-item
        }

        blockquote,
        dd,
        dl,
        figure,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        p,
        pre {
            margin: 0
        }

        fieldset {
            margin: 0;
            padding: 0
        }

        legend {
            padding: 0
        }

        menu,
        ol,
        ul {
            list-style: none;
            margin: 0;
            padding: 0
        }

        textarea {
            resize: vertical
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af
        }

        [role=button],
        button {
            cursor: pointer
        }

        :disabled {
            cursor: default
        }

        audio,
        canvas,
        embed,
        iframe,
        img,
        object,
        svg,
        video {
            display: block;
            vertical-align: middle
        }

        img,
        video {
            max-width: 100%;
            height: auto
        }

        [hidden] {
            display: none
        }

        *,
        ::before,
        ::after {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::-webkit-backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        ::backdrop {
            --tw-border-spacing-x: 0;
            --tw-border-spacing-y: 0;
            --tw-translate-x: 0;
            --tw-translate-y: 0;
            --tw-rotate: 0;
            --tw-skew-x: 0;
            --tw-skew-y: 0;
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            --tw-pan-x: ;
            --tw-pan-y: ;
            --tw-pinch-zoom: ;
            --tw-scroll-snap-strictness: proximity;
            --tw-ordinal: ;
            --tw-slashed-zero: ;
            --tw-numeric-figure: ;
            --tw-numeric-spacing: ;
            --tw-numeric-fraction: ;
            --tw-ring-inset: ;
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            --tw-ring-color: rgb(59 130 246 / 0.5);
            --tw-ring-offset-shadow: 0 0 #0000;
            --tw-ring-shadow: 0 0 #0000;
            --tw-shadow: 0 0 #0000;
            --tw-shadow-colored: 0 0 #0000;
            --tw-blur: ;
            --tw-brightness: ;
            --tw-contrast: ;
            --tw-grayscale: ;
            --tw-hue-rotate: ;
            --tw-invert: ;
            --tw-saturate: ;
            --tw-sepia: ;
            --tw-drop-shadow: ;
            --tw-backdrop-blur: ;
            --tw-backdrop-brightness: ;
            --tw-backdrop-contrast: ;
            --tw-backdrop-grayscale: ;
            --tw-backdrop-hue-rotate: ;
            --tw-backdrop-invert: ;
            --tw-backdrop-opacity: ;
            --tw-backdrop-saturate: ;
            --tw-backdrop-sepia:
        }

        .relative {
            position: relative
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .mx-6 {
            margin-left: 1.5rem;
            margin-right: 1.5rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-16 {
            margin-top: 4rem
        }

        .mt-6 {
            margin-top: 1.5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .mr-1 {
            margin-right: 0.25rem
        }

        .flex {
            display: flex
        }

        .inline-flex {
            display: inline-flex
        }

        .grid {
            display: grid
        }

        .h-16 {
            height: 4rem
        }

        .h-7 {
            height: 1.75rem
        }

        .h-6 {
            height: 1.5rem
        }

        .h-5 {
            height: 1.25rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .w-auto {
            width: auto
        }

        .w-16 {
            width: 4rem
        }

        .w-7 {
            width: 1.75rem
        }

        .w-6 {
            width: 1.5rem
        }

        .w-5 {
            width: 1.25rem
        }

        .max-w-7xl {
            max-width: 80rem
        }

        .shrink-0 {
            flex-shrink: 0
        }

        .scale-100 {
            --tw-scale-x: 1;
            --tw-scale-y: 1;
            transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .gap-6 {
            gap: 1.5rem
        }

        .gap-4 {
            gap: 1rem
        }

        .self-center {
            align-self: center
        }

        .rounded-lg {
            border-radius: 0.5rem
        }

        .rounded-full {
            border-radius: 9999px
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .bg-red-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(254 242 242 / var(--tw-bg-opacity))
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .from-gray-700\/50 {
            --tw-gradient-from: rgb(55 65 81 / 0.5);
            --tw-gradient-to: rgb(55 65 81 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to)
        }

        .via-transparent {
            --tw-gradient-to: rgb(0 0 0 / 0);
            --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to)
        }

        .bg-center {
            background-position: center
        }

        .stroke-red-500 {
            stroke: #ef4444
        }

        .stroke-gray-400 {
            stroke: #9ca3af
        }

        .p-6 {
            padding: 1.5rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .text-center {
            text-align: center
        }

        .text-right {
            text-align: right
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem
        }

        .font-semibold {
            font-weight: 600
        }

        .leading-relaxed {
            line-height: 1.625
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity))
        }

        .underline {
            -webkit-text-decoration-line: underline;
            text-decoration-line: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .shadow-2xl {
            --tw-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --tw-shadow-colored: 0 25px 50px -12px var(--tw-shadow-color);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
        }

        .shadow-gray-500\/20 {
            --tw-shadow-color: rgb(107 114 128 / 0.2);
            --tw-shadow: var(--tw-shadow-colored)
        }

        .transition-all {
            transition-property: all;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .focus\:rounded-sm:focus {
            border-radius: 0.125rem
        }

        .focus\:outline:focus {
            outline-style: solid
        }

        .focus\:outline-2:focus {
            outline-width: 2px
        }

        .focus\:outline-red-500:focus {
            outline-color: #ef4444
        }

        .group:hover .group-hover\:stroke-gray-600 {
            stroke: #4b5563
        }

        .z-10 {
            z-index: 10
        }

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (prefers-color-scheme: dark) {
            .dark\:bg-gray-900 {
                --tw-bg-opacity: 1;
                background-color: rgb(17 24 39 / var(--tw-bg-opacity))
            }

            .dark\:bg-gray-800\/50 {
                background-color: rgb(31 41 55 / 0.5)
            }

            .dark\:bg-red-800\/20 {
                background-color: rgb(153 27 27 / 0.2)
            }

            .dark\:bg-dots-lighter {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E")
            }

            .dark\:bg-gradient-to-bl {
                background-image: linear-gradient(to bottom left, var(--tw-gradient-stops))
            }

            .dark\:stroke-gray-600 {
                stroke: #4b5563
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity))
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .dark\:shadow-none {
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;
                box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow)
            }

            .dark\:ring-1 {
                --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
                --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color);
                box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000)
            }

            .dark\:ring-inset {
                --tw-ring-inset: inset
            }

            .dark\:ring-white\/5 {
                --tw-ring-color: rgb(255 255 255 / 0.05)
            }

            .dark\:hover\:text-white:hover {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity))
            }

            .group:hover .dark\:group-hover\:stroke-gray-400 {
                stroke: #9ca3af
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrackLearn - Platform E-Learning dengan Tracking Progress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <i class="fas fa-graduation-cap text-3xl text-purple-600"></i>
                    <span class="ml-2 text-2xl font-bold text-gray-800">TrackLearn</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#beranda" class="text-gray-700 hover:text-purple-600 transition">Beranda</a>
                    <a href="#fitur" class="text-gray-700 hover:text-purple-600 transition">Fitur</a>
                    <a href="#kursus" class="text-gray-700 hover:text-purple-600 transition">Kursus</a>
                    <a href="#testimoni" class="text-gray-700 hover:text-purple-600 transition">Testimoni</a>
                </div>
                <div class="flex space-x-4">
                    <a href="{{ route('login') }}"
                        class="px-4 py-2 text-purple-600 hover:text-purple-700 font-semibold transition">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-md">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg pt-24 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1 class="text-5xl font-bold mb-6">Belajar Online dengan Tracking Progress Real-Time</h1>
                    <p class="text-xl mb-8 text-gray-100">Platform e-learning yang memungkinkan Anda melacak progres
                        belajar layaknya tracking pesanan e-commerce. Transparan, terstruktur, dan mudah!</p>
                    <div class="flex space-x-4">
                        <a href="{{ route('register') }}"
                            class="px-8 py-3 bg-white text-purple-600 rounded-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                            Mulai Sekarang
                        </a>
                        <a href="#fitur"
                            class="px-8 py-3 border-2 border-white text-white rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://cdnjs.cloudflare.com/ajax/libs/twemoji/14.0.2/svg/1f4da.svg" alt="Learning"
                        class="w-full ">
                </div>
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section id="fitur" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan TrackLearn</h2>
                <p class="text-gray-600 text-lg">Berbagai fitur untuk mendukung perjalanan belajar Anda</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Fitur 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Tracking Progress</h3>
                    <p class="text-gray-600">Pantau progres belajar Anda secara real-time dari enroll hingga mendapatkan sertifikat. Seperti tracking paket, tapi untuk pembelajaran!</p>
                </div>

                <!-- Fitur 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-certificate text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Sertifikat Otomatis</h3>
                    <p class="text-gray-600">Dapatkan sertifikat digital secara otomatis setelah menyelesaikan kursus dan lulus kuis dengan nilai minimal yang ditentukan.</p>
                </div>

                <!-- Fitur 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-tasks text-3xl text-green-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Kuis Interaktif</h3>
                    <p class="text-gray-600">Evaluasi pemahaman Anda dengan kuis interaktif yang dinilai otomatis. Sistem validasi memastikan pembelajaran berjalan bertahap.</p>
                </div>

                <!-- Fitur 4 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-video text-3xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Materi Lengkap</h3>
                    <p class="text-gray-600">Akses berbagai format materi pembelajaran: video YouTube, PDF, dan dokumen. Semua dalam satu platform terpadu.</p>
                </div>

                <!-- Fitur 5 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user-graduate text-3xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Multi-Role System</h3>
                    <p class="text-gray-600">Sistem role yang jelas: Admin mengelola platform, Guru membuat konten, Siswa belajar dengan nyaman.</p>
                </div>

                <!-- Fitur 6 -->
                <div class="bg-white p-8 rounded-xl shadow-lg card-hover">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-3xl text-indigo-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Responsif</h3>
                    <p class="text-gray-600">Akses dari desktop, tablet, atau smartphone. Tampilan responsif yang nyaman di semua perangkat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Kursus Populer -->
    <section id="kursus" class="py-20 px-4 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Kursus Populer</h2>
                <p class="text-gray-600 text-lg">Pilihan kursus terbaik untuk meningkatkan skill Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Kursus 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-r from-purple-400 to-pink-400 flex items-center justify-center">
                        <i class="fas fa-code text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Web Development Fundamentals</h3>
                        <p class="text-gray-600 mb-4">Pelajari dasar-dasar pemrograman web dari HTML, CSS hingga JavaScript</p>
                        <div class="flex items-center justify-between">
                            <span class="text-purple-600 font-semibold">15 Materi • 5 Kuis</span>
                            <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">Lihat</button>
                        </div>
                    </div>
                </div>

                <!-- Kursus 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-r from-blue-400 to-cyan-400 flex items-center justify-center">
                        <i class="fas fa-database text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Database Management</h3>
                        <p class="text-gray-600 mb-4">Menguasai PostgreSQL dan konsep database relasional</p>
                        <div class="flex items-center justify-between">
                            <span class="text-blue-600 font-semibold">12 Materi • 4 Kuis</span>
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Lihat</button>
                        </div>
                    </div>
                </div>

                <!-- Kursus 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-r from-green-400 to-teal-400 flex items-center justify-center">
                        <i class="fas fa-project-diagram text-white text-6xl"></i>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Laravel Framework Mastery</h3>
                        <p class="text-gray-600 mb-4">Bangun aplikasi web modern dengan Laravel PHP Framework</p>
                        <div class="flex items-center justify-between">
                            <span class="text-green-600 font-semibold">20 Materi • 8 Kuis</span>
                            <button class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Lihat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni -->
    <section id="testimoni" class="py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Apa Kata Mereka?</h2>
                <p class="text-gray-600 text-lg">Pengalaman pengguna TrackLearn</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Testimoni 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-purple-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-purple-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                            <p class="text-sm text-gray-600">Siswa</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">"Fitur tracking progress sangat membantu! Saya bisa tahu persis di mana posisi saya dalam proses belajar. Sangat recommended!"</p>
                </div>

                <!-- Testimoni 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Siti Nurhaliza</h4>
                            <p class="text-sm text-gray-600">Guru</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">"Platform yang mudah digunakan untuk membuat kursus. Sistem kuis otomatis menghemat banyak waktu saya dalam menilai siswa."</p>
                </div>

                <!-- Testimoni 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-green-600"></i>
                        </div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Budi Santoso</h4>
                            <p class="text-sm text-gray-600">Siswa</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                        <i class="fas fa-star text-yellow-400"></i>
                    </div>
                    <p class="text-gray-600">"Sertifikat otomatis langsung terbit setelah lulus kuis. Prosesnya cepat dan transparan. Sangat profesional!"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <i class="fas fa-graduation-cap text-2xl text-purple-400"></i>
                        <span class="ml-2 text-xl font-bold">TrackLearn</span>
                    </div>
                    <p class="text-gray-400">Platform e-learning dengan sistem tracking progress yang transparan dan terstruktur.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Menu</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#fitur" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#kursus" class="text-gray-400 hover:text-white transition">Kursus</a></li>
                        <li><a href="#testimoni" class="text-gray-400 hover:text-white transition">Testimoni</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i> info@tracklearn.id</li>
                        <li><i class="fas fa-phone mr-2"></i> +62 812-3456-7890</li>
                        <li><i class="fas fa-map-marker-alt mr-2"></i> Universitas Lampung</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4">Sosial Media</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://github.com/WildanMukmin/track-learn" target="_blank" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-purple-600 transition">
                            <i class="fab fa-github"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 TrackLearn - Universitas Lampung. Developed by Wildan Mukmin, Nafisya Yagtias, Daniel Okto M.S, Imam Ahdy Sabilla</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>