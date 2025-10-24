<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Galery;

class FixGaleryCategories extends Command
{
    protected $signature = 'galery:fix-categories';
    protected $description = 'Fix invalid category values in galery table';

    public function handle()
    {
        $this->info('Checking galery categories...');
        
        $validCategories = ['umum', 'ekstrakurikuler', 'prestasi', 'pplg', 'tjkt', 'tpfl', 'to', 'transforkrab', 'maulid-nabi', 'neospragma', 'p5', 'upacara', 'adiwiyata', 'pmr', 'pramuka', 'osis', 'lainnya'];
        
        // Use DB query to avoid model casting issues
        $galeries = \DB::table('galery')->select('id', 'category')->get();
        $fixed = 0;
        
        foreach ($galeries as $galery) {
            $category = $galery->category;
            
            // Check if category is invalid (contains timestamp pattern, is numeric, or not in valid list)
            $isInvalid = !in_array($category, $validCategories) 
                || preg_match('/\d{4}-\d{2}-\d{2}/', $category)
                || is_numeric($category)
                || empty($category);
                
            if ($isInvalid) {
                $this->warn("Gallery ID {$galery->id} has invalid category: " . ($category ?: 'NULL'));
                
                // Set to 'umum' as default using DB query
                \DB::table('galery')->where('id', $galery->id)->update(['category' => 'umum']);
                
                $this->info("  → Fixed to: umum");
                $fixed++;
            }
        }
        
        if ($fixed > 0) {
            $this->info("\nFixed {$fixed} galleries with invalid categories.");
        } else {
            $this->info("\nAll galleries have valid categories!");
        }
        
        // Show current category distribution
        $this->info("\nCurrent category distribution:");
        $distribution = Galery::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();
            
        foreach ($distribution as $item) {
            $this->line("  {$item->category}: {$item->count}");
        }
        
        return 0;
    }
}
