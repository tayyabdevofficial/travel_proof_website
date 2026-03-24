<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ContactMessage;
use App\Models\VisaConsultation;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $totalContacts = ContactMessage::count();
        $totalConsultations = VisaConsultation::count();
        $consultationsPaid = VisaConsultation::where('payment_status', 'paid')->count();
        $consultationsPending = VisaConsultation::where('payment_status', 'pending')->count();

        $statusCounts = Booking::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $days = collect(range(6, 0))->map(function ($i) {
            return Carbon::today()->subDays($i);
        });

        $bookingsByDay = $days->map(function ($day) {
            return Booking::whereDate('created_at', $day)->count();
        });

        $labels = $days->map(fn ($day) => $day->format('M d'));

        return view('dashboard', [
            'totalBookings' => $totalBookings,
            'pendingBookings' => $pendingBookings,
            'completedBookings' => $completedBookings,
            'totalContacts' => $totalContacts,
            'totalConsultations' => $totalConsultations,
            'consultationsPaid' => $consultationsPaid,
            'consultationsPending' => $consultationsPending,
            'statusCounts' => $statusCounts,
            'chartLabels' => $labels,
            'chartData' => $bookingsByDay,
        ]);
    }
}
