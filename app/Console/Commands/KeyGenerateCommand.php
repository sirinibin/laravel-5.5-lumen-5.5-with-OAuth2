<?php
/*
Implemented the solution on
https://stackoverflow.com/questions/30344141/lumen-micro-framework-php-artisan-keygenerate
because the first php artisan key:generate wasn't working
*/
namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class KeyGenerateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'key:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Set the application key";
	
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $key = $this->getRandomKey();

        if ($this->option('show')) {
            return $this->line('<comment>'.$key.'</comment>');
        }

        $path = base_path('.env');

        if (file_exists($path)) {
            file_put_contents(
                $path,
                str_replace('APP_KEY='.env('APP_KEY'), 'APP_KEY='.$key, file_get_contents($path))
            );
        }

        $this->info("Application key [$key] set successfully.");
    }

    /**
     * Generate a random key for the application.
     *
     * @return string
     */
    protected function getRandomKey()
    {
        return Str::random(32);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('show', null, InputOption::VALUE_NONE, 'Simply display the key instead of modifying files.'),
        );
    }

      public function handle(){
$this->fire();
       	}

}
