<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;

class ClearAppCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:clear-app {--all : Clear all application caches}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear application-specific caches for Sentra Sehat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Clearing Sentra Sehat application caches...');

        // Clear dashboard-related caches
        $this->clearDashboardCaches();

        // Clear coordinate caches
        $this->clearCoordinateCaches();

        // Clear disease-related caches
        $this->clearDiseaseCaches();

        if ($this->option('all')) {
            $this->info('Clearing all Laravel caches...');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            $this->info('All Laravel caches cleared.');
        }

        $this->info('Application caches cleared successfully!');
        return 0;
    }

    private function clearDashboardCaches()
    {
        $patterns = [
            'dashboard_totals_*',
            'disease_distribution_*'
        ];

        foreach ($patterns as $pattern) {
            $keys = Cache::store('redis')->getRedis()->keys($pattern);
            if (!empty($keys)) {
                Cache::store('redis')->deleteMultiple($keys);
                $this->line("Cleared " . count($keys) . " dashboard cache keys matching: $pattern");
            }
        }
    }

    private function clearCoordinateCaches()
    {
        $keys = Cache::store('redis')->getRedis()->keys('coordinates_*');
        if (!empty($keys)) {
            Cache::store('redis')->deleteMultiple($keys);
            $this->line("Cleared " . count($keys) . " coordinate cache keys");
        }
    }

    private function clearDiseaseCaches()
    {
        $keys = Cache::store('redis')->getRedis()->keys('wilayah_diseases_*');
        if (!empty($keys)) {
            Cache::store('redis')->deleteMultiple($keys);
            $this->line("Cleared " . count($keys) . " disease cache keys");
        }
    }
}
