<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class CreateModelWithPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model-with-permissions {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a model and update permissions config file';

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
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $modelName = Str::studly($name);
        $modelVariable = lcfirst($name);

        // Create model using Artisan command
        $this->call('make:model', ['name' => $modelName]);

        // Update permissions config file
        $configPath = config_path('permissions.php');
        $config = include $configPath;

        // Add new permissions to the 'access' array
        $newPermissions = [
            "{$modelVariable}-list" => "{$modelVariable}_list",
            "{$modelVariable}-edit" => "{$modelVariable}_edit",
            "{$modelVariable}-add" => "{$modelVariable}_add",
            "{$modelVariable}-delete" => "{$modelVariable}_delete",
        ];

        // Merge new access permissions with existing ones
        foreach ($newPermissions as $key => $value) {
            $config['access'][$key] = $value;
        }

        // Add model name to 'table_modules' if not already present
        if (!in_array($modelVariable, $config['table_modules'])) {
            $config['table_modules'][] = $modelVariable;
        }

        // Convert the config array to a PHP file string without indices
        $configString = "<?php\n\nreturn [\n";

        // Convert 'access' array to string
        $configString .= "    'access' => [\n";
        foreach ($config['access'] as $accessKey => $accessValue) {
            $configString .= "        '{$accessKey}' => '{$accessValue}',\n";
        }
        $configString .= "    ],\n";

        // Convert 'table_modules' array to string
        $configString .= "    'table_modules' => [\n";
        foreach ($config['table_modules'] as $tableModule) {
            $configString .= "        '{$tableModule}',\n";
        }
        $configString .= "    ],\n";

        // Convert 'action' array to string
        $configString .= "    'action' => [\n";
        foreach ($config['action'] as $action) {
            $configString .= "        '{$action}',\n";
        }
        $configString .= "    ],\n";

        $configString .= "];\n";

        // Write back to config file
        File::put($configPath, $configString);

        $this->info("Model {$modelName} created and permissions updated successfully.");

    }
}
