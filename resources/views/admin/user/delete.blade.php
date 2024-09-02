<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <!-- Sidebar -->
        @include('admin.user.sidebar')
        <!-- Main Content -->
         <!-- Main Content -->
         <div class="container">
            @include('partials.flash_messages')
            <!-- Breadcrumb -->
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item"><a href="{{route('admin.user.view')}}">User</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Delete</li>
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
                        <th>Phone</th>
                        <th>User Type</th>
                        <th>Faculty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->matricNumber }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->usertype }}</td>
                        <td>{{ $user->faculty }}</td>
                        <td>
                            <form class="deleteUserForm" action="{{ route('admin.user.delete', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-2">Delete User</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach event listener to all forms with class 'deleteUserForm'
            document.querySelectorAll('.deleteUserForm').forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent the form from submitting immediately

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // If confirmed, submit the form
                            form.submit(); // Use form instead of this to reference the correct form
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
