<x-layouts::app :title="__('Dashboard')">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-sm text-gray-600">Overview of bookings, contacts, and consultations.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 mb-8">
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="text-xs text-gray-500">Total Bookings</div>
                <div class="text-2xl font-bold text-gray-900">{{ $totalBookings }}</div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="text-xs text-gray-500">Pending</div>
                <div class="text-2xl font-bold text-gray-900">{{ $pendingBookings }}</div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="text-xs text-gray-500">Completed</div>
                <div class="text-2xl font-bold text-gray-900">{{ $completedBookings }}</div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="text-xs text-gray-500">Contact Messages</div>
                <div class="text-2xl font-bold text-gray-900">{{ $totalContacts }}</div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="text-xs text-gray-500">Visa Consultations</div>
                <div class="text-2xl font-bold text-gray-900">{{ $totalConsultations }}</div>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-4">
                <div class="text-xs text-gray-500">Consultation Payments</div>
                <div class="mt-2 flex flex-wrap gap-2 text-xs font-semibold">
                    <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-green-800">Paid: {{ $consultationsPaid }}</span>
                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-1 text-yellow-800">Pending: {{ $consultationsPending }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Bookings (Last 7 Days)</h2>
                <canvas id="bookingsChart" height="120"></canvas>
            </div>
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Booking Status</h2>
                <canvas id="statusChart" height="120"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const initDashboardCharts = () => {
                if (!window.Chart) return;
                const bookingLabels = @json($chartLabels);
                const bookingData = @json($chartData);
                const statusLabels = @json($statusCounts->keys());
                const statusData = @json($statusCounts->values());
                const statusColors = {
                    pending: '#f59e0b',
                    processing: '#3b82f6',
                    rejected: '#ef4444',
                    refunded: '#a855f7',
                    completed: '#10b981',
                    default: '#6b7280',
                };
                const statusBackgrounds = statusLabels.map((label) => {
                    const key = String(label || '').toLowerCase();
                    return statusColors[key] || statusColors.default;
                });

                const bookingsCtx = document.getElementById('bookingsChart');
                if (bookingsCtx) {
                    if (window.__dashboardBookingsChart) {
                        window.__dashboardBookingsChart.destroy();
                    }
                    window.__dashboardBookingsChart = new Chart(bookingsCtx, {
                        type: 'bar',
                        data: {
                            labels: bookingLabels,
                            datasets: [{
                                label: 'Bookings',
                                data: bookingData,
                                backgroundColor: '#2563eb',
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                }

                const statusCtx = document.getElementById('statusChart');
                if (statusCtx) {
                    if (window.__dashboardStatusChart) {
                        window.__dashboardStatusChart.destroy();
                    }
                    window.__dashboardStatusChart = new Chart(statusCtx, {
                        type: 'doughnut',
                        data: {
                            labels: statusLabels,
                            datasets: [{
                                data: statusData,
                                backgroundColor: statusBackgrounds,
                            }]
                        },
                        options: {
                            responsive: true,
                        }
                    });
                }
            };

            window.addEventListener('load', initDashboardCharts);
            document.addEventListener('livewire:navigated', initDashboardCharts);
            document.addEventListener('turbo:load', initDashboardCharts);
        </script>
    @endpush
</x-layouts::app>
