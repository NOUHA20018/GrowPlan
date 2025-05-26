<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Apprenant | {{ config('app.name', 'Laravel') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/apprenantStyle/app.css')}}">

</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        @include('layoutsApprenant.sidebare')
        
        <!-- Page content -->
        <div class="flex-grow-1">
            <!-- Top navbar -->
            @include('layoutsApprenant.navbar')
            <!-- Main content -->
            <main class="container-fluid py-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Toggle sidebar on mobile
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarCollapse = document.getElementById('sidebarCollapse');
            const sidebar = document.querySelector('.sidebar');
            
            if (sidebarCollapse && sidebar) {
                sidebarCollapse.addEventListener('click', function() {
                    sidebar.classList.toggle('d-none');
                });
            }
            // Enable tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>