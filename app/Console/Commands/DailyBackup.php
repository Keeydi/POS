<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DailyBackup extends Command
{
    protected $signature = 'backup:daily';
    protected $description = 'Create daily database backup';

    public function handle()
    {
        $this->info('Starting daily backup...');

        $date = Carbon::now()->format('Y-m-d');
        $filename = "backup_{$date}.sql";
        $backupPath = storage_path("app/backups/{$filename}");

        // Ensure backup directory exists
        if (!file_exists(storage_path('app/backups'))) {
            mkdir(storage_path('app/backups'), 0755, true);
        }

        // Get database credentials
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        // Create mysqldump command
        $command = sprintf(
            'mysqldump -h %s -u %s -p%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($backupPath)
        );

        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Backup created successfully: {$filename}");
            
            // Compress backup
            $zipPath = storage_path("app/backups/backup_{$date}.zip");
            $zip = new \ZipArchive();
            if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
                $zip->addFile($backupPath, $filename);
                $zip->close();
                unlink($backupPath); // Delete SQL file after zipping
                $this->info("Backup compressed: backup_{$date}.zip");
            }

            // Keep only last 30 days of backups
            $this->cleanOldBackups();

            return Command::SUCCESS;
        } else {
            $this->error('Backup failed!');
            return Command::FAILURE;
        }
    }

    protected function cleanOldBackups()
    {
        $backupDir = storage_path('app/backups');
        $files = glob($backupDir . '/backup_*.zip');
        
        foreach ($files as $file) {
            $fileDate = Carbon::createFromTimestamp(filemtime($file));
            if ($fileDate->diffInDays(Carbon::now()) > 30) {
                unlink($file);
                $this->info("Deleted old backup: " . basename($file));
            }
        }
    }
}
