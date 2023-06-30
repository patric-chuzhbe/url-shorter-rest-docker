<?php

namespace App\Console\Commands;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use Illuminate\Console\Command;

class test00 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test00';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test00';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*< new methods>*/
    private const SUFFIX_LENGTH = 6;

    private function getRandomSymbols()
    {
        return bin2hex(random_bytes(self::SUFFIX_LENGTH / 2));
    }
    /*</new methods>*/

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*< testCode>*/
        if (1) {
            $logFile = fopen("log00for_App.Console.Commands.test00.handle.log", "ab");
            fwrite($logFile, "line: " . __LINE__ . "\n\t\$this->getRandomSymbols(): " . print_r($this->getRandomSymbols(), true) . "\n\n");
            fclose($logFile);
        }
        /*</testCode>*/
        echo "DONE\n";
        return 0;
    }
}
