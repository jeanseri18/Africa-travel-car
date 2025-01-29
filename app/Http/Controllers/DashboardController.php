<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Calcul du nombre total de réservations
        $totalReservations = Reservation::count();
    
        // Nombre de réservations pour le mois en cours
        $monthlyReservations = Reservation::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
    
        // Nombre de réservations pour l'année en cours
        $yearlyReservations = Reservation::whereYear('created_at', Carbon::now()->year)
            ->count();
    
        // Récupération du total payé pour le mois, l'année et le total
        $totalPaid = Reservation::sum('total_paye');
        $monthlyPaid = Reservation::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total_paye');
        $yearlyPaid = Reservation::whereYear('created_at', Carbon::now()->year)
            ->sum('total_paye');
    
        // Data pour le graphique mensuel
        $monthlyData = [];
        $monthlyLabels = [];
    
        // Boucle sur les mois de l'année
        for ($month = 1; $month <= 12; $month++) {
            $monthlyData[] = Reservation::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
            $monthlyLabels[] = Carbon::create()->month($month)->format('F'); // noms des mois
        }
    
        // Envoi des données à la vue
        return view('admin.dashboard', compact(
            'totalReservations', 
            'monthlyReservations', 
            'yearlyReservations',
            'totalPaid',
            'monthlyPaid',
            'yearlyPaid',
            'monthlyLabels', // Envoi des labels des mois à la vue
            'monthlyData'    // Envoi des données des réservations à la vue
        ));
    }
    
}
