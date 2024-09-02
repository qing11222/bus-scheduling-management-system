<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">
        <!-- Sidebar -->
        @include('admin.user.sidebar')

        <!-- Main Content -->
         <!-- Main Content -->
         <div class="container" style="max-width: 80%; margin: 0 auto;">
            @include('partials.flash_messages')
            <!-- Breadcrumb -->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
              </nav>
              <br>
            <h1 class="table-title">User Content</h1>

            <table class="google-form-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Matric Number</th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th>Faculty</th>
                        <th>Gender</th>
                        <th>Course</th>
                        <th>User Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->matricNumber}}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->faculty}}</td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->course }}</td>
                        <td>{{ $user->usertype}}</td>

                        <td>
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-primary mt-2">Edit</a>
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </x-app-layout>
