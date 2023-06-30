<?php

namespace App\Console\Commands;

use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Link;
use Exception;
use Illuminate\Console\Command;

class test01 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test01';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'test01';

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
    private const UNIQUE_SUFFIX_ATTEMPTS_MAX = 20;

    private const SUFFIX_LENGTH = 6;

    private function isSuffixUnique(string $randomSymbols)
    {
        return Link::where('short_url_suffix', '=', $randomSymbols)->count() === 0;
    }

    private function getRandomSymbols()
    {
        /*< testCode>*/
        $isDebug = false;
        if (!$isDebug) {
            /*</testCode>*/
            return bin2hex(random_bytes(self::SUFFIX_LENGTH / 2));
            /*< testCode>*/
        }
        /*</testCode>*/
        /*< testCode>*/
        if ($isDebug) {
            return 'df2038';
        }
        /*</testCode>*/
    }

    public function generateShortUrlSuffix(): string
    {
        for ($i = 0; $i <= self::UNIQUE_SUFFIX_ATTEMPTS_MAX; ++$i) {
            $randomSymbols = $this->getRandomSymbols();
            if ($this->isSuffixUnique($randomSymbols)) {
                return $randomSymbols;
            }
        }
        throw new Exception(
            'Не удалось сгенерировать уникальный суффикс короткого URL за '
            . self::UNIQUE_SUFFIX_ATTEMPTS_MAX
            . ' попыток'
        );
    }
    /*</new methods>*/

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        for ($i = 0; $i < 5; ++$i) {
            /*< testCode>*/
            if (1) {
                $logFile = fopen("log01for_App.Console.Commands.test01.handle.log", "ab");
                fwrite(
                    $logFile,
                    "line: " .
                    __LINE__ .
                    "\n\t\$this->generateShortUrlSuffix(): " .
                    print_r($this->generateShortUrlSuffix(), true) .
                    "\n\n"
                );
                fclose($logFile);
            }
            /*</testCode>*/
        }
        echo "DONE\n";
        return 0;
    }
}
