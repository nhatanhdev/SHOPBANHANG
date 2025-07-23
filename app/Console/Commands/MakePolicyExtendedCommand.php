<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakePolicyExtendedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:policy-extended {name : The name of the policy class} {--model= : The model class that the policy applies to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new policy class and integrate into PermissionGateAndPolicy service';

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
        $policyName = $this->argument('name');
        $modelName = $this->option('model');

        // Generate the policy
        $this->call('make:policy', [
            'name' => $policyName,
            '--model' => $modelName,
        ]);

        // Integrate policy into PermissionGateAndPolicy service
        $this->integratePolicyIntoService($policyName, $modelName);

        $this->info("Policy $policyName created and integrated successfully.");
    }

    protected function integratePolicyIntoService($policyName, $modelName)
    {
        $serviceFilePath = app_path('Services/PermissionGateAndPolicy.php');
        $policyClass = Str::studly($policyName);
        // $modelNamePlural = Str::plural(lcfirst($modelName));
        $modelNamePlural = (lcfirst($modelName));

        // Check if file exists and readable
        if (File::exists($serviceFilePath) && File::isReadable($serviceFilePath)) {
            // Read the current content of PermissionGateAndPolicy.php
            $content = File::get($serviceFilePath);

            // Append integration code to the service file
            $integrationCode = "\n\n    // Policy for $modelNamePlural\n";
            $integrationCode .= "    public function defineGate$modelName()\n";
            $integrationCode .= "    {\n";
            $integrationCode .= "        Gate::define('$modelNamePlural-list', 'App\Policies\\$policyClass@view');\n";
            $integrationCode .= "        Gate::define('$modelNamePlural-add', 'App\Policies\\$policyClass@create');\n";
            $integrationCode .= "        Gate::define('$modelNamePlural-edit', 'App\Policies\\$policyClass@update');\n";
            $integrationCode .= "        Gate::define('$modelNamePlural-delete', 'App\Policies\\$policyClass@delete');\n";
            $integrationCode .= "    }\n";

            // Find the position to insert the code (right before the closing bracket if present)
            $insertPosition = strrpos($content, '}');

            if ($insertPosition !== false) {
                // Insert the integration code before the last closing bracket
                $updatedContent = substr_replace($content, $integrationCode, $insertPosition, 0);

                // Write the updated content back to PermissionGateAndPolicy.php
                File::put($serviceFilePath, $updatedContent);

                $this->info("Policy methods integrated into PermissionGateAndPolicy service.");
            } else {
                $this->error("Unable to find appropriate place to insert code in PermissionGateAndPolicy.php.");
            }
        } else {
            $this->error("Service file PermissionGateAndPolicy.php not found or not readable.");
        }
    }
}
