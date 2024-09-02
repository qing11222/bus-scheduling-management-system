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
                    <li class="breadcrumb-item active" aria-current="page">Help</li>
                  </ol>
              </nav>
            <!-- Help Content -->
            <div class="help-content">
                <h2>Frequently Asked Questions</h2>
                <hr>

                <h4>Q: How do I add a new driver?</h4>
                <p>A: To add a new driver, click on the "Add Driver" button on the sidebar and fill out the required information. Make sure to save your changes when you're done.</p>

                <h4>Q: How do I delete a driver?</h4>
                <p>A: To delete a driver, go to the "Delete Driver" page and click on the "Delete" button next to the driver you want to remove. Confirm that you want to delete the driver to complete the action.</p>

                <!-- Add more questions and answers here -->
            </div>
        </div>
    </div>
    </x-app-layout>
