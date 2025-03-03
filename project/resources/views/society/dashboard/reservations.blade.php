<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Society Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }
        .sidebar a:hover {
            background: #495057;
            border-radius: 5px;
        }
        .main-content {
            flex-grow: 1;
            padding: 20px;
            background-color: #ffcccc;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav class="sidebar">
        <h4>Dashboard</h4>
        <a href="#">📦 Offers</a>
        <a href="#">👥 Clients</a>
        <a href="#">📅 Reservations</a>
        <a href="#">📊 Statistics</a>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <h2>Society Dashboard</h2>

        <!-- Statistics -->
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Offers</h5>
                        <p class="card-text">15</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Clients</h5>
                        <p class="card-text">230</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Reservations</h5>
                        <p class="card-text">74</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text">$12,400</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Offers Table -->
        <div class="card mt-4">
            <div class="card-header">Offers List</div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Reservations</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Summer Trip</td>
                            <td>$500</td>
                            <td>30</td>
                            <td>12</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                        <tr>
                            <td>Winter Getaway</td>
                            <td>$750</td>
                            <td>20</td>
                            <td>15</td>
                            <td><span class="badge bg-secondary">Inactive</span></td>
                        </tr>
                        <tr>
                            <td>Luxury Cruise</td>
                            <td>$2000</td>
                            <td>50</td>
                            <td>40</td>
                            <td><span class="badge bg-success">Active</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>
