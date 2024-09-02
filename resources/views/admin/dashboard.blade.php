<x-app-layout>
    <!-- Main Layout with Sidebar -->
    <div class="flex">


        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
            <p class="mb-4">Welcome to your dashboard!</p>

            <!-- Charts Container -->
            <div class="flex flex-wrap -mx-4 ">
                <!-- Total Users Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Drivers and Users</h2>
                        <canvas id="totalUsersChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Monthly Users Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Monthly Account Created</h2>
                        <canvas id="userCountsChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Users by Faculty Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Users by Faculty</h2>
                        <canvas id="facultyChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Users by Age Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-gray-100 p-4 rounded-lg shadow ">
                        <h2 class="text-xl font-semibold mb-2">Users by Age</h2>
                        <canvas id="ageChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Users by gender Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8 chart-container ">
                    <div class="bg-gray-100 p-4 rounded-lg shadow  ">
                        <h2 class="text-xl font-semibold mb-2">Users by Gender</h2>
                        <canvas id="genderChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Users by course Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Users by Course</h2>
                        <canvas id="courseChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Average working of drivers -->
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Average working hours (drivers)</h2>
                        <canvas id="workingChart" class="w-full h-64"></canvas>
                    </div>
                </div>

                <!-- Bus Schedule Graph -->
                <div class="w-full md:w-1/3 px-4 mb-8 " style="margin-left: 490px">
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h2 class="text-xl font-semibold mb-2">Number of Schedules per Bus</h2>
                        <canvas id="busSchedulesChart" class="w-full h-64" ></canvas>
                    </div>
                </div>


            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Total Users Chart
                const ctx1 = document.getElementById('totalUsersChart').getContext('2d');
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: @json(array_keys($totalUsers)), // User types
                        datasets: [{
                            label: 'Total Users',
                            data: @json(array_values($totalUsers)),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Monthly Users Chart
                const ctx2 = document.getElementById('userCountsChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'line',
                    data: {
                        labels: @json($months),
                        datasets: [{
                            label: 'Monthly Users',
                            data: @json($userCounts),
                            borderColor: 'rgba(54, 162, 235, 1)', // Change border color to blue
                            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Change background color to light blue
                            borderWidth: 1,
                            fill: true
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Get the context of the canvas element
                const ctx = document.getElementById('facultyChart').getContext('2d');

                // Initialize the chart
                const facultyChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: @json($faculty), // Labels for the x-axis (faculties)
                        datasets: [{
                            label: 'Number of Users', // Label for the dataset
                            data: @json($count), // Data for the y-axis (user counts)
                            backgroundColor: 'rgba(75, 192, 192, 0.2)', // Bar color
                            borderColor: 'rgba(75, 192, 192, 1)', // Bar border color
                            borderWidth: 1 // Bar border width
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Start y-axis at zero
                            }
                        }
                    }

                });
                // Users by Age Chart
                const ctx4 = document.getElementById('ageChart').getContext('2d');
                new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels: @json($ageLabels),
                        datasets: [{
                            label: 'Number of Users',
                            data: @json($ageValues),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)', // Color for first segment
                                'rgba(54, 162, 235, 0.2)', // Color for second segment
                                'rgba(255, 206, 86, 0.2)', // Color for third segment
                                'rgba(75, 192, 192, 0.2)', // Color for fourth segment
                                'rgba(153, 102, 255, 0.2)', // Color for fifth segment
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)', // Border color for first segment
                                'rgba(54, 162, 235, 1)', // Border color for second segment
                                'rgba(255, 206, 86, 1)', // Border color for third segment
                                'rgba(75, 192, 192, 1)', // Border color for fourth segment
                                'rgba(153, 102, 255, 1)', // Border color for fifth segment
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Users by Gender Chart
                const ctx5 = document.getElementById('genderChart').getContext('2d');
                new Chart(ctx5, {
                    type: 'pie',
                    data: {
                        labels: @json($genderLabels),
                        datasets: [{
                            label: 'Number of Users',
                            data: @json($genderValues),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)', // Color for first segment
                                'rgba(54, 162, 235, 0.2)', // Color for second segment
                                'rgba(255, 206, 86, 0.2)', // Color for third segment
                                'rgba(75, 192, 192, 0.2)', // Color for fourth segment
                                'rgba(153, 102, 255, 0.2)', // Color for fifth segment
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)', // Border color for first segment
                                'rgba(54, 162, 235, 1)', // Border color for second segment
                                'rgba(255, 206, 86, 1)', // Border color for third segment
                                'rgba(75, 192, 192, 1)', // Border color for fourth segment
                                'rgba(153, 102, 255, 1)', // Border color for fifth segment
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Users by Course Chart
                const ctx6 = document.getElementById('courseChart').getContext('2d');
                new Chart(ctx6, {
                    type: 'bar',
                    data: {
                        labels: @json($courseLabels),
                        datasets: [{
                            label: 'Number of Users',
                            data: @json($courseValues),
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange
                            borderColor: 'rgba(255, 159, 64, 1)', // Orange border
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                // Users by Course Chart
                const ctx7 = document.getElementById('workingChart').getContext('2d');
                new Chart(ctx7, {
                    type: 'bar',
                    data: {
                        labels: @json(array_values($userNames)), // User names
                        datasets: [{
                            label: 'Average Working Time (Hours)',
                            data: @json(array_values($workingTimes)), // Average working time
                            backgroundColor: 'rgba(255, 159, 64, 0.2)', // Orange
                            borderColor: 'rgba(255, 159, 64, 1)', // Orange border
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                const ctx8 = document.getElementById('busSchedulesChart').getContext('2d');
            new Chart(ctx8, {
                type: 'bar',
                data: {
                    labels: @json($busLabels),
                    datasets: [{
                        label: 'Total Schedules',
                        data: @json($scheduleValues),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
            </script>
        </div>
    </div>
</x-app-layout>
