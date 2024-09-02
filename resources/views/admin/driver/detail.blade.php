<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        <div class="sidebar">
            <x-driver-sidebar />
        </div>


        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.driver.view')}}">Drivers</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
              </nav>
              <h1 class="table-title">Driver Details</h1>
              <table class="table table-striped driver-details-table">
                  <thead>
                      <tr>
                          <th>Attribute</th>
                          <th>Detail</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Name</td>
                          <td>{{ $driver->name }}</td>
                      </tr>
                      <tr>
                          <td>License Number</td>
                          <td>{{ $driver->license_number }}</td>
                      </tr>
                      <tr>
                          <td>Contact Number</td>
                          <td>{{ $driver->phone }}</td>
                      </tr>
                      <tr>
                          <td>Email</td>
                          <td>{{ $driver->email }}</td>
                      </tr>

                  </tbody>
              </table>
        </div>
    </div>
      <!-- Custom CSS -->
      <style>




        .container {
            flex-grow: 1;
            padding: 20px;
        }


        .table-title {
            margin-bottom: 20px;
        }

        .driver-details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .driver-details-table th,
        .driver-details-table td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        .driver-details-table th {
            background-color: #f1f1f1;
            font-weight: bold;
        }

        .driver-details-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .driver-details-table tr:hover {
            background-color: #f1f1f1;
        }
    </style>
    </x-app-layout>
