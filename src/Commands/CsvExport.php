<?php

namespace Dipenparmar12\Exportable\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CsvExport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'csv:export  {--all} { tables* : Export csv files of all tables}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export database tables to csv file (default dir is database/csv/<file_name>.csv )';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Wait......');

        ///// For all table export
        if ($this->argument('tables')[0] === 'tables' and $this->option('all')) {
            $this->warn("ALl Tables");
            foreach ($this->get_db_tables() as $table) {
//                User::get()->toArray();
                $this->writeCsv(DB::table($table)->get(), $table, true);
            }
        } else {
//            $this->warn("Some Tables");
            foreach (collect($this->argument('tables')) as $table) {
                if (Schema::hasTable($table)) {
                    $this->writeCsv(DB::table($table)->get(), $table, true);
                } else {
                    $this->warn("table $table is not exists.");
                }
            }
        }

        $this->info('');
        $this->info('Csv files exported Successfully.');
    }

    protected function writeCsv($data, $name, $heading = true, $directory = 'database/csv')
    {
        $csv_directory = $this->checkOrMakeDir(base_path() . '/' . $directory);
        $csv_file_path = $csv_directory . '/' . $name . '.csv';

        ///// METHOD ONE
        if (is_countable($data)) {
            $file_headers = false;
            $csv_file_handler = fopen($csv_file_path, 'w');
            $bar = $this->output->createProgressBar(count($data));
            $bar->start();
            foreach ($data as $key => $row) {
                $row = collect($row)->toArray();
                if (is_array($row)) {
                    if ($heading and empty($file_headers)) {
                        $file_headers = array_keys($row);
                        fputcsv($csv_file_handler, $file_headers);
                        $file_headers = array_flip($file_headers);
                    }
                    fputcsv($csv_file_handler, $row);
                } else {
                    fputcsv($csv_file_handler, [$row]);
                }
                $bar->advance();
            }
            fclose($csv_file_handler);
            $bar->finish();
            $this->info(' ' . $name . '.csv');
        }
    }

    protected function checkOrMakeDir($path)
    {
        if (!File::exists($path)) {
            if (File::makeDirectory($path)) {
                return $path;
            }
        }
        return $path;
    }

    protected function get_db_tables()
    {
        $databaseName = DB::getDatabaseName();
        $tables_info = DB::select("SELECT * FROM information_schema.tables WHERE table_schema = '$databaseName'");
        $tables = [];
        foreach ($tables_info as $table_info) {
            if (Schema::hasTable($table_info->TABLE_NAME)) {
                $tables[] = $table_info->TABLE_NAME;
            }
        }
        return (count($tables) > 0) ? $tables : [];
    }
}
