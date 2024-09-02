<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- Include your CSS file -->
    <div class="flex">
        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.announcement.view') }}">Announcement</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
            <div class="form-custom">
                @include('partials.flash_messages')

                <form action="{{ route('admin.announcement.update', ['announcement' => $announcement->AnnouncementID]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><label for="Title">Title</label></td>
                                <td><input type="text" name="Title" id="Title" class="form-control" value="{{ $announcement->Title }}" required></td>
                            </tr>
                            <tr>
                                <td><label for="Description">Description</label></td>
                                <td><textarea name="Description" id="Description" class="form-control" rows="3" required>{{ $announcement->Description }}</textarea></td>
                            </tr>
                            <tr>
                                <td><label for="DatePosted">Date Posted</label></td>
                                <td>
                                    @php
                                    $today = date('Y-m-d'); // Get today's date in YYYY-MM-DD format
                                    @endphp
                                    <input type="date" class="form-control @error('DatePosted') is-invalid @enderror" id="DatePosted" name="DatePosted" value="{{ $announcement->DatePosted }}" min="{{ $today }}" max="{{ $today }}" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="RouteID">Route</label></td>
                                <td>
                                    <select name="RouteID" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach ($routes as $route)
                                            <option value="{{ $route->RouteID }}" {{ $route->RouteID == $announcement->RouteID ? 'selected' : '' }}>{{ $route->Description }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <!-- Update Button -->
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

            <!-- Delete Form -->
            <form action="{{ route('admin.announcement.destroy', ['announcement' => $announcement->AnnouncementID]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this announcement?');" style="margin-top: 15px;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </div>
        </div>
    </div>
</x-app-layout>
