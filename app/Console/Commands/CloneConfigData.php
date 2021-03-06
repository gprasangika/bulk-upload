<?php

namespace App\Console\Commands;

use App\Http\Controllers\CloneController;
use App\Models\Academic_period;
use Illuminate\Console\Command;
use App\Models\Institution_shift;

class CloneConfigData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clone:config {year} {max}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clone configuration data for new year';

    protected $start_time;
    protected  $end_time;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->shifts = new Institution_shift();
        $this->academic_period = new Academic_period();
        $this->clone = new CloneController();
        $this->output = new \Symfony\Component\Console\Output\ConsoleOutput();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->start_time = microtime(TRUE);
        $year = $this->argument('year');
        $shift = $this->shifts->getShiftsToClone($year - 1);
        $previousAcademicPeriod = $this->academic_period->getAcademicPeriod($year - 1);
        $academicPeriod = $this->academic_period->getAcademicPeriod($year);

        $params = [
            'year' => $year,
            'academic_period' => $academicPeriod,
            'previous_academic_period' => $previousAcademicPeriod
        ];
        // dd($shift);
        $function = array($this->clone, 'process');
        // array_walk($shift,$function,$params);
        processParallel($function,$shift, $this->argument('max'),$params);
        $this->end_time = microtime(TRUE);


        $this->output->writeln('$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$');
        $this->output->writeln('The cook took ' . ($this->end_time - $this->start_time) . ' seconds to complete');
        $this->output->writeln('$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$');
    }  
}
