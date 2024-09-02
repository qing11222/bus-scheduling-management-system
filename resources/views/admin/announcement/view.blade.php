<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">

        <div class="container">
            @include('partials.flash_messages')

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Announcement</li>
                </ol>
            </nav>
            <br>

            <h1 class="table-title">Announcement Content</h1>
            <a href="{{ route('admin.announcement.create') }}" class="btn btn-primary">Create Announcement</a>

            @if ($announcements->isEmpty())
                <div class="alert alert-info">
                    No announcements available.
                </div>
            @else
                <table class="google-form-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date Posted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                            <tr>
                                <td>{{ $announcement->Title }}</td>
                                <td>{{ $announcement->Description }}</td>
                                <td>{{ $announcement->DatePosted }}</td>
                                <td>
                                    <!-- Correct the parameter name here -->
                                    <a href="{{ route('admin.announcement.edit', $announcement->AnnouncementID) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('admin.announcement.destroy', $announcement) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>
