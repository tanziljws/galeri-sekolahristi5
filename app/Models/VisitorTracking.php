<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitorTracking extends Model
{
    use HasFactory;

    protected $table = 'visitor_tracking';

    protected $fillable = [
        'ip_address',
        'user_agent',
        'referer',
        'page',
        'visited_at'
    ];

    protected $casts = [
        'visited_at' => 'datetime'
    ];

    /**
     * Get unique visitors count for a period
     */
    public static function getUniqueVisitors($days = 7)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->distinct('ip_address')
            ->count();
    }

    /**
     * Get total visits for a period
     */
    public static function getTotalVisits($days = 7)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->count();
    }

    /**
     * Get daily visitor stats
     */
    public static function getDailyStats($days = 7)
    {
        return self::where('created_at', '>=', now()->subDays($days))
            ->selectRaw('DATE(created_at) as date, COUNT(DISTINCT ip_address) as unique_visitors, COUNT(*) as total_visits')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
