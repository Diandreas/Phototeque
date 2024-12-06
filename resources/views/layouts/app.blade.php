<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
{{--    <style>--}}
{{--        /* Styles pour le tableau exportable */--}}
{{--        .table-exportable {--}}
{{--            min-width: 100%;--}}
{{--            border-collapse: collapse;--}}
{{--        }--}}

{{--        .table-exportable th {--}}
{{--            background-color: #f3f4f6;--}}
{{--            font-weight: 600;--}}
{{--        }--}}

{{--        .table-exportable th,--}}
{{--        .table-exportable td {--}}
{{--            padding: 12px;--}}
{{--            border: 1px solid #e5e7eb;--}}
{{--        }--}}

{{--        @media print {--}}
{{--            .no-print {--}}
{{--                display: none !important;--}}
{{--            }--}}

{{--            .table-exportable {--}}
{{--                page-break-inside: auto;--}}
{{--            }--}}

{{--            .table-exportable tr {--}}
{{--                page-break-inside: avoid;--}}
{{--                page-break-after: auto;--}}
{{--            }--}}

{{--            .table-exportable thead {--}}
{{--                display: table-header-group;--}}
{{--            }--}}

{{--            .table-exportable tfoot {--}}
{{--                display: table-footer-group;--}}
{{--            }--}}
{{--        }--}}
{{--    </style>--}}

    <style>
        /* Contrasté Background */
        .bg-pattern {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            background-image:
                radial-gradient(at 47% 33%, #3b82f6 0, transparent 59%),
                radial-gradient(at 82% 65%, #4f46e5 0, transparent 55%);
        }

        /* Navigation Contrasted */
        .nav-glass {
            background: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Card Style Contrasted */
        .content-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 16px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }


        /* Navigation Links with High Contrast */
        .nav-link-custom {
            position: relative;
            color: #e2e8f0;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .nav-link-custom::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            background-color: #3b82f6;
            transition: all 0.3s ease;
        }

        .nav-link-custom:hover {
            color: #ffffff;
        }

        .nav-link-custom:hover::after {
            width: 80%;
            left: 10%;
        }

        .nav-link-custom.active {
            color: #ffffff;
        }

        .nav-link-custom.active::after {
            width: 80%;
            left: 10%;
            background-color: #60a5fa;
        }

        /* User Dropdown Enhanced */
        .user-dropdown {
            background: #1e293b;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .dropdown-item-custom {
            color: #e2e8f0;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 4px;
            padding: 8px 16px;
        }

        .dropdown-item-custom:hover {
            background-color: #2d3748;
            color: #ffffff;
            transform: translateX(5px);
        }

        /* App Logo Contrasted */
        .app-logo {
            font-weight: 700;
            background: linear-gradient(135deg, #60a5fa, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: opacity 0.3s ease;
        }

        .app-logo:hover {
            opacity: 0.9;
        }

        /* Header Section */
        .header-section {
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-section h1 {
            color: white;
        }

        /* User Profile Info */
        .user-profile {
            background: linear-gradient(135deg, #3b82f6 0%, #4f46e5 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .user-avatar {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* Footer High Contrast */
        .footer-modern {
            background: #0f172a;
            color: #ffffff;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-link {
            color: #94a3b8;
            transition: color 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .footer-link:hover {
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* Cards and Sections */
        .section-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Buttons Enhanced */
        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6 0%, #4f46e5 100%);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        /* Table Styling */
        .table-custom {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom th {
            background: #f8fafc;
            color: #1e293b;
            font-weight: 600;
            padding: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .table-custom td {
            padding: 1rem;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-custom tr:hover {
            background: #f1f5f9;
        }
    </style>
</head>
<body class="bg-pattern antialiased">
<div class="min-h-screen flex flex-col">
    <!-- Navigation -->
    <nav class="nav-glass sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <x-application-logo class="h-8 w-auto"></x-application-logo>
                    <a href="{{ route('dashboard') }}" class="app-logo text-2xl ml-3">
                        {{ config('app.name', 'Laravel') }}
                    </a>

                    <div class="hidden sm:flex sm:ml-10 space-x-8">
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="nav-link-custom">
                            <i class="bi bi-house-door me-2"></i>{{ __('Home') }}
                        </x-nav-link>
                        <x-nav-link :href="route('terms.index')" :active="request()->routeIs('terms.*')" class="nav-link-custom">
                            <i class="bi bi-tags me-2"></i>{{ __('Terms') }}
                        </x-nav-link>
                        <x-nav-link :href="route('images.index')" :active="request()->routeIs('images.*')" class="nav-link-custom">
                            <i class="bi bi-images me-2"></i>{{ __('Images') }}
                        </x-nav-link>
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')" class="nav-link-custom">
                            <i class="bi bi-people me-2"></i>{{ __('Users') }}
                        </x-nav-link>
                    </div>
                </div>

                <div class="flex items-center">
                    <x-dropdown align="right" width="48" class="user-dropdown">
                        <x-slot name="trigger">
                            <button class="user-profile">
                                <div class="user-avatar">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down ms-2"></i>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')" class="dropdown-item-custom">
                                <i class="bi bi-person me-2"></i>{{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();"
                                                 class="dropdown-item-custom text-red-400">
                                    <i class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    @isset($header)
        <header class="header-section">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    {{ $header }}
                </h1>
            </div>
        </header>
    @endisset

    <!-- Main Content -->
    <main class="flex-grow py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="content-card">
                <div class="p-6">
                    @yield('content')
                    @if(isset($slot))
                        {{ $slot }}
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer-modern">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                <p class="text-sm font-medium">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }} By Daouda. All rights reserved.
                </p>
                <div class="flex space-x-6">
                    <a href="#" class="footer-link">
                        <i class="bi bi-shield-check"></i>
                        Privacy Policy
                    </a>
                    <a href="#" class="footer-link">
                        <i class="bi bi-file-text"></i>
                        Terms of Service
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportTableToExcel() {
        const table = document.getElementById('imagesTable');
        const wb = XLSX.utils.table_to_book(table, {sheet: "Images"});
        XLSX.writeFile(wb, 'images_database.xlsx');
    }

    function exportTableToPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF('l', 'pt', 'a3');

        doc.html(document.getElementById('imagesTable'), {
            callback: function (doc) {
                doc.save('images_database.pdf');
            },
            margin: [60, 60, 60, 60],
            x: 10,
            y: 10
        });
    }

    // Style d'impression
    const style = document.createElement('style');
    style.textContent = `
    @media print {
        body * {
            visibility: hidden;
        }
        #imagesTable, #imagesTable * {
            visibility: visible;
        }
        #imagesTable {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
`;
    document.head.appendChild(style);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
@stack('scripts')
</body>
</html>
