<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}"> <!-- Include your CSS file -->
    <div class="flex">

        <!-- Main Content -->
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('admin.announcement.view')}}">Annoucement</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
            <div class="form-custom">
                <h1>Create Announcement</h1>
                @include('partials.flash_messages')

                <form action="{{ route('admin.announcement.store') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <td><label for="Title">Title</label></td>
                            <td>
                                <input type="text" class="form-control @error('Title') is-invalid @enderror" id="Title" name="Title" value="{{ old('Title') }}" class="form-control" required>
                                @error('Title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="Description">Description</label></td>
                            <td>
                                <textarea class="form-control @error('Description') is-invalid @enderror" id="Description" name="Description" rows="3" required>{{ old('Description') }}</textarea>
                                @error('Description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </td>
                        </tr>
                        <tr>
                            <td> <label for="DatePosted">Date Posted</label></td>
                            @php
                            $today = date('Y-m-d'); // Get today's date in YYYY-MM-DD format
                            @endphp
                            <td>
                            <input type="date" class="form-control @error('DatePosted') is-invalid @enderror" id="DatePosted" name="DatePosted" value="{{ $today }}" min="{{ $today }}" max="{{ $today }}" required>
                            </td>
                            </tr>
                             <tr>
                            <td><label for="RouteID">Route</label></td>
                            <td>
                                <select class="form-control @error('RouteID') is-invalid @enderror" id="RouteID" name="RouteID" required>
                                    <!-- Assume $routes is passed to the view with all available routes -->
                                    @foreach ($routes as $route)
                                        <option value="{{ $route->RouteID }}">{{ $route->Description }}</option>
                                    @endforeach
                                </select>
                                @error('RouteID')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </td>
                        </tr>

                    </table>
                    <button type="submit" class="btn btn-primary">Create Announcement</button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
