<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Administration')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

    <body class="bg-light">
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold text-primary" href="{{ route('dashboard') }}">
                    <i class="fas fa-school me-2"></i>School Administration

                </a>
            </div>
        </nav>



        <!-- Main Content -->
        <div class="d-flex min-vh-100">
            <!-- Sidebar -->
            <aside class="bg-white shadow-sm" style="width: 250px; min-height: 100vh;">
                <div class="p-3">
                    <h6 class="text-muted text-uppercase small fw-bold mb-3">Management</h6>
                    <nav class="nav flex-column">
                        <a href="{{ route('students.index') }}" class="nav-link d-flex align-items-center text-dark ">
                            <i class="fas fa-user-graduate me-2"></i>Students
                        </a>


                    </nav>

                    <h6 class="text-muted text-uppercase small fw-bold mb-3">Management</h6>
                    <nav class="nav flex-column">
                        <a href="{{ route('teachers.index') }}" class="nav-link d-flex align-items-center text-dark ">
                            <i class="fas fa-user-graduate me-2"></i>Teachers
                        </a>


                    </nav>

                    <h6 class="text-muted text-uppercase small fw-bold mt-4 mb-3">Activities</h6>
                    <nav class="nav flex-column">


                    </nav>


                </div>
            </aside>

            <!-- Content Area -->
            <main class="flex-fill p-4">
                @yield('content')
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>


</html>
