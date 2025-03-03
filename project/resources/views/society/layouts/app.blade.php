<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Society Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #343a40; color: white; padding: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background: #495057; border-radius: 5px; }
        .main-content { flex-grow: 1; padding: 20px; background-color: #ebe9e9; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h4>Dashboard</h4>
        <a href="">📈 Statistics</a>
        <a href="{{route('society.dashboard.offer')}}">📦 Offers</a>
        <a href="">👥 Clients</a>
        <a href="">📅 Reservations</a>
        
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')  <!-- Hna ghayji kolchi dial les pages -->
    </main>
        @yield('scripts')
</body>
</html>
