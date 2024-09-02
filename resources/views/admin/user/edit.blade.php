<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">
        <!-- Sidebar -->
        @include('admin.user.sidebar')

        <!-- Main Content -->
        <div class="container">
            @include('partials.flash_messages')

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.user.view') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
            <br>

            <h1 class="table-title">Edit User</h1>
            <table class="google-form-table">
                <!-- User Edit Form -->
                <form action="{{ route('admin.user.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">

                    <tbody>
                        <!-- Always editable fields -->
                        <tr>
                            <td><label for="name">Name</label></td>
                            <td><input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}"></td>
                        </tr>

                        <tr>
                            <td><label for="email">Email</label></td>
                            <td><input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}"></td>
                        </tr>

                        <tr>
                            <td><label for="phone">Phone</label></td>
                            <td><input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}"></td>
                        </tr>

                        <tr>
                            <td><label for="age">Age</label></td>
                            <td><input type="number" name="age" class="form-control" value="{{ old('age', $user->age) }}"></td>
                        </tr>

                        <tr>
                            <td><label for="gender">Gender</label></td>
                            <td>
                                <select name="gender" class="form-control">
                                    <option value="" disabled>Select Gender</option>
                                    <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </td>
                        </tr>

                        @if($user->usertype === 'user')
                            <!-- Fields editable by users -->


                            <tr>
                                <td><label for="faculty">Faculty</label></td>
                                <td><select class="form-control" id="faculty" name="faculty" required>
                                    <option value="" disabled>Select Faculty</option>
                                    <option value="FKE" {{ old('faculty', $user->faculty) == 'FKE' ? 'selected' : '' }}>FKE</option>
                                    <option value="FKEKK" {{ old('faculty', $user->faculty) == 'FKEKK' ? 'selected' : '' }}>FKEKK</option>
                                    <option value="FKM" {{ old('faculty', $user->faculty) == 'FKM' ? 'selected' : '' }}>FKM</option>
                                    <option value="FKP" {{ old('faculty', $user->faculty) == 'FKP' ? 'selected' : '' }}>FKP</option>
                                    <option value="FTMK" {{ old('faculty', $user->faculty) == 'FTMK' ? 'selected' : '' }}>FTMK</option>
                                    <option value="FPTT" {{ old('faculty', $user->faculty) == 'FPTT' ? 'selected' : '' }}>FPTT</option>
                                    <option value="FTK" {{ old('faculty', $user->faculty) == 'FTK' ? 'selected' : '' }}>FTK</option>
                                </select></td>
                            </tr>

                            <tr>
                                <td><label for="matricNumber">Matric Number</label></td>
                                <td><input type="text" name="matricNumber" class="form-control" value="{{ old('matricNumber', $user->matricNumber) }}"></td>
                            </tr>

                            <tr>
                                <td><label for="course">Course</label></td>
                                <td>
                                    <select name="course" class="form-control">
                                        <option value="" disabled>Select a course</option>
                                        <option value="Computer Science" {{ old('course', $user->course) == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                                        <option value="Engineering" {{ old('course', $user->course) == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                                        <option value="Business Administration" {{ old('course', $user->course) == 'Business Administration' ? 'selected' : '' }}>Business Administration</option>
                                        <option value="Mechanical Engineering" {{ old('course', $user->course) == 'Mechanical Engineering' ? 'selected' : '' }}>Mechanical Engineering</option>
                                        <option value="Electrical Engineering" {{ old('course', $user->course) == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                        <option value="Civil Engineering" {{ old('course', $user->course) == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                                        <option value="Aerospace Engineering" {{ old('course', $user->course) == 'Aerospace Engineering' ? 'selected' : '' }}>Aerospace Engineering</option>
                                        <option value="Information Technology" {{ old('course', $user->course) == 'Information Technology' ? 'selected' : '' }}>Information Technology</option>
                                        <!-- Add more UTeM courses as needed -->
                                    </select>
                                </td>
                            </tr>

                        @endif

                        <tr>
                            <td><label for="usertype">User Type</label></td>
                            <td><div class="form-control" style="border: none; background-color: #e9ecef;">{{ $user->usertype }}</div></td>
                        </tr>
                    </tbody>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </table>
        </div>
    </div>
</x-app-layout>
