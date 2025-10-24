<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Galery;

class AutoCategorizeGaleries extends Command
{
    protected $signature = 'galery:auto-categorize';
    protected $description = 'Automatically categorize galleries based on their title keywords';

    public function handle()
    {
        $this->info('Auto-categorizing galleries based on title keywords...');
        
        // Define keyword patterns for each category
        $categoryKeywords = [
            'prestasi' => ['prestasi', 'juara', 'lomba', 'kompetisi', 'penghargaan', 'medali', 'trophy'],
            'upacara' => ['upacara', 'bendera', 'apel'],
            'maulid-nabi' => ['maulid', 'maulud', 'nabi'],
            'p5' => ['p5', 'projek penguatan', 'profil pelajar'],
            'adiwiyata' => ['adiwiyata', 'lingkungan', 'hijau'],
            'neospragma' => ['neospragma', 'neo spragma'],
            'pmr' => ['pmr', 'palang merah'],
            'pramuka' => ['pramuka', 'pramuka'],
            'osis' => ['osis', 'mpk', 'organisasi siswa'],
            'ekstrakurikuler' => ['ekskul', 'ekstrakurikuler', 'ekstrakulikuler'],
            'pplg' => ['pplg', 'rpl', 'perangkat lunak'],
            'tjkt' => ['tjkt', 'tkj', 'jaringan'],
            'tpfl' => ['tpfl', 'las', 'pengelasan'],
            'to' => ['to', 'otomotif', 'mesin'],
            'transforkrab' => ['transforkrab', 'transformasi'],
        ];
        
        // Use DB query to avoid model casting issues
        $galeries = \DB::table('galery')->select('id', 'judul', 'post_id', 'category')->get();
        $categorized = 0;
        $unchanged = 0;
        
        foreach ($galeries as $galery) {
            $title = strtolower($galery->judul ?? '');
            
            // If no judul, try to get from post
            if (empty($title) && $galery->post_id) {
                $post = \DB::table('posts')->where('id', $galery->post_id)->first();
                $title = strtolower($post->judul ?? '');
            }
            
            $currentCategory = $galery->category;
            $newCategory = null;
            
            // Skip if already has a valid non-umum category
            if ($currentCategory && $currentCategory !== 'umum') {
                $unchanged++;
                continue;
            }
            
            // Check each category's keywords
            foreach ($categoryKeywords as $category => $keywords) {
                foreach ($keywords as $keyword) {
                    if (stripos($title, $keyword) !== false) {
                        $newCategory = $category;
                        break 2; // Break both loops
                    }
                }
            }
            
            // If a matching category was found, update it
            if ($newCategory && $newCategory !== $currentCategory) {
                \DB::table('galery')->where('id', $galery->id)->update(['category' => $newCategory]);
                
                $this->info("✓ Gallery ID {$galery->id}: \"{$title}\" → {$newCategory}");
                $categorized++;
            } else {
                $unchanged++;
            }
        }
        
        $this->info("\n=== Summary ===");
        $this->info("Categorized: {$categorized}");
        $this->info("Unchanged: {$unchanged}");
        
        // Show current distribution
        $this->info("\n=== Current Category Distribution ===");
        $distribution = Galery::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->orderBy('count', 'desc')
            ->get();
            
        foreach ($distribution as $item) {
            $this->line("  {$item->category}: {$item->count}");
        }
        
        return 0;
    }
}
