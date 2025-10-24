<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Galery;

class FixCorruptedGaleryTimestamps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'galery:fix-timestamps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix corrupted timestamps in galery table where created_at or updated_at contains invalid data like "umum"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting to fix corrupted timestamps in galery table...');
        
        $fixedCount = 0;
        
        // Get all galery records
        $galeries = DB::table('galery')->get();
        
        foreach ($galeries as $galery) {
            $needsUpdate = false;
            $updates = [];
            
            // Check if created_at is corrupted
            try {
                if ($galery->created_at) {
                    // Try to parse the date
                    $date = new \DateTime($galery->created_at);
                }
            } catch (\Exception $e) {
                // If parsing fails, it's corrupted
                $updates['created_at'] = now();
                $needsUpdate = true;
                $this->warn("Galery ID {$galery->id}: Corrupted created_at = '{$galery->created_at}'");
            }
            
            // Check if updated_at is corrupted
            try {
                if ($galery->updated_at) {
                    // Try to parse the date
                    $date = new \DateTime($galery->updated_at);
                }
            } catch (\Exception $e) {
                // If parsing fails, it's corrupted
                $updates['updated_at'] = now();
                $needsUpdate = true;
                $this->warn("Galery ID {$galery->id}: Corrupted updated_at = '{$galery->updated_at}'");
            }
            
            // Update if needed
            if ($needsUpdate) {
                DB::table('galery')
                    ->where('id', $galery->id)
                    ->update($updates);
                $fixedCount++;
                $this->info("Fixed Galery ID {$galery->id}");
            }
        }
        
        if ($fixedCount > 0) {
            $this->info("Successfully fixed {$fixedCount} corrupted timestamp(s)!");
        } else {
            $this->info("No corrupted timestamps found. All data is clean!");
        }
        
        return Command::SUCCESS;
    }
}
