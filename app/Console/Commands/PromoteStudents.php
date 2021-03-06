<?php

namespace App\Console\Commands;

use App\Http\Controllers\BulkPromotion;
use Webpatser\Uuid\Uuid;
use App\Institution_grade;
use App\Models\Institution;
use App\Models\Academic_period;
use App\Models\Education_grade;
use Illuminate\Console\Command;
use App\Models\Institution_class;
use Illuminate\Support\Facades\DB;
use App\Models\Institution_student;
use App\Models\Institution_subject;
use Illuminate\Support\Facades\Log;
use App\Models\Institution_class_student;
use App\Models\Institution_class_subject;
use App\Models\Institution_subject_student;
use App\Models\Institution_student_admission;

/**
 * Class PromoteStudents
 * @package App\Console\Commands
 */
class PromoteStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promote:students  {institution} {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Promote students';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->instituion_grade = new \App\Models\Institution_grade();
    }



    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $year = $this->argument('year');
        $institution = $this->argument('institution');
        $institutionGrade = $this->instituion_grade->getInstitutionGradeToPromoted($year,$institution);
        (new BulkPromotion())->callback($institutionGrade,$year);
    }
}
