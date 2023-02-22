<?php

namespace app\command;


use Doctrine\Inflector\InflectorFactory;
use RuntimeException;
use support\Db;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;
use Webman\Console\Util;


class MakeModule extends Command
{
    protected static $defaultName = 'make:module';
    protected static $defaultDescription = 'make module';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->addArgument('name', InputArgument::REQUIRED, 'Name description');
        $this->addArgument('model', InputArgument::REQUIRED, 'Model description');
        $this->addArgument('service', InputArgument::REQUIRED, 'Service description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $output->writeln("Make controller $name");

        $serviceName = $input->getArgument('service');
        $output->writeln("Make service $name");
        $name = str_replace('\\', '/', $name);

        ['name' => $controller_name, 'file' => $controller_file, 'namespace' => $controller_namespace] = $this->getControllerName($name);
        $serviceName = str_replace('\\', '/', $serviceName);
        ['name' => $serviceName, 'file' => $serviceFile, 'namespace' => $serviceNameSpace] = $this->getServicesName($serviceName);
        $this->createController($controller_name, $controller_namespace, $controller_file, $serviceName, $serviceNameSpace);
        $modelName = $input->getArgument('model');
        $modelName = Util::nameToClass($modelName);
        $output->writeln("Make model $modelName");
        ['name' => $modelName, 'file' => $file, 'namespace' => $namespace] = $this->getModelName($modelName);
        $this->createModel($modelName, $namespace, $file);
        $this->createService($serviceName, $serviceNameSpace, $serviceFile, $modelName, $namespace);
        return self::SUCCESS;
    }

    /**
     * @param $name
     * @param $namespace
     * @param $file
     * @param $serviceName
     * @param $serviceNameSpace
     * @return void
     */
    protected function createController($name, $namespace, $file, $serviceName, $serviceNameSpace): void
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path) && !mkdir($path, 0777, true) && !is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
        $service = $serviceNameSpace . '\\' . $serviceName;
        $controller_content = <<<EOF
<?php

namespace $namespace;

use app\Request;
use support\Response;
use $service;
class $name
{
    public function index(Request \$request,$serviceName \$Service): Response
    {
        return \$Service->index(\$request);
    }
    public function store(Request \$request,$serviceName \$Service): Response
    {
        return \$Service->store(\$request);
    }
    public function show(Request \$request,int \$id,$serviceName \$Service): Response
    {
        return \$Service->show(\$id);
    }
    public function update(Request \$request,int \$id,$serviceName \$Service): Response
    {
        return \$Service->updateById(\$request,\$id);
    }
    public function destroy(Request \$request,int \$id,$serviceName \$Service): Response
    {
        return \$Service->destroyById(\$id);
    }

}

EOF;
        file_put_contents($file, $controller_content);
    }

    /**
     * @param $class
     * @param $namespace
     * @param $file
     * @return void
     */
    protected function createModel($class, $namespace, $file): void
    {
        $path = pathinfo($file, PATHINFO_DIRNAME);
        if (!is_dir($path) && !mkdir($path, 0777, true) && !is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
        $table = Util::classToName($class);
        $table_val = 'null';
        $pk = 'id';
        $properties = '';
        try {
            $prefix = config('database.connections.mysql.prefix') ?? '';
            $database = config('database.connections.mysql.database');
            $inflector = InflectorFactory::create()->build();
            $table_plural = $inflector->pluralize($inflector->tableize($class));
            if (Db::select("show tables like '%$prefix$table_plural%'")) {
                $table = "$prefix$table_plural";
            } else if (Db::select("show tables like '%$prefix$table%'")) {
                $table_val = "'$table'";
                $table = "$prefix$table";
            }
            $fillable = [];
            foreach (Db::select("select COLUMN_NAME,DATA_TYPE,COLUMN_KEY,COLUMN_COMMENT from INFORMATION_SCHEMA.COLUMNS where table_name = '$table' and table_schema = '$database'") as $item) {
                if ($item->COLUMN_KEY === 'PRI') {
                    $pk = $item->COLUMN_NAME;
                    $item->COLUMN_COMMENT .= "(主键)";
                }
                if ($item->COLUMN_NAME != 'id') {
                    $fillable[] = "'$item->COLUMN_NAME'";
                }
                $type = $this->getType($item->DATA_TYPE);
                $properties .= " * @property $type \$$item->COLUMN_NAME $item->COLUMN_COMMENT\n";
            }
        } catch (Throwable $e) {
        }
        $properties = rtrim($properties) ?: ' *';
        $tableName = $table ?: $table_val;
        $fillable = '[' . implode(',', $fillable) . ']';
        $model_content = <<<EOF
<?php

namespace $namespace;

use support\Model;

/**
$properties
 */
class $class extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected \$table = '$tableName';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected \$primaryKey = '$pk';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public \$timestamps = true;
    protected \$fillable=$fillable;
    
}

EOF;
        file_put_contents($file, $model_content);
    }

    /**
     * @param string $type
     * @return string|null
     */
    protected function getType(string $type): ?string
    {
        if (str_contains($type, 'int')) {
            return 'integer';
        }
        return match ($type) {
            'varchar', 'string', 'text', 'date', 'time', 'guid', 'datetimetz', 'datetime', 'decimal', 'enum' => 'string',
            'boolean' => 'integer',
            'float' => 'float',
            default => 'mixed',
        };
    }

    private function createService(string $serviceName, string $serviceNameSpace, string $serviceFile, $modelName, $modelNameSpace): void
    {
        $path = pathinfo($serviceFile, PATHINFO_DIRNAME);
        if (!is_dir($path) && !mkdir($path, 0777, true) && !is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
        $m_name = $modelNameSpace . '\\' . $modelName;
        $controller_content = <<<EOF
<?php

namespace $serviceNameSpace;
use app\Services\BaseService;
use app\Request;
use Illuminate\Validation\ValidationException;
use support\\exception\BusinessException;
use DI\Attribute\Inject;
use $m_name;

class $serviceName extends BaseService
{
    #[Inject($modelName::class)]
    protected \$model;
    protected \$form;
    protected \$validate;

    /**
     * @throws ValidationException
     * @throws BusinessException
     */
    public function setForm(Request \$request): void
    {
        ['code'=>\$code,'data'=>\$data,'msg'=>\$msg]=  \$this->validate->goCheck(\$request->all());
        if (\$code){
            throw new BusinessException(\$msg,\$code);
        }
    
        \$this->form= \$data;
    }
}

EOF;
        file_put_contents($serviceFile, $controller_content);
    }

    protected function getControllerName($name): array
    {
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $controller_str = Util::guessPath(app_path(), 'controller') ?: 'controller';
            $file = app_path() . "/$controller_str/$name.php";
            $namespace = 'app\controller';
        } else {
            $name_str = substr($name, 0, $pos);
            if ($real_name_str = Util::guessPath(app_path(), $name_str)) {
                $name_str = $real_name_str;
            } else if ($real_section_name = Util::guessPath(app_path(), strstr($name_str, '/', true))) {
                $upper = strtolower($real_section_name[0]) !== $real_section_name[0];
            } else if ($real_base_controller = Util::guessPath(app_path(), 'controller')) {
                $upper = strtolower($real_base_controller[0]) !== $real_base_controller[0];
            }
            $upper = $upper ?? strtolower($name_str[0]) !== $name_str[0];
            if ($upper && !$real_name_str) {
                $name_str = preg_replace_callback('/\/([a-z])/', function ($matches) {
                    return '/' . strtoupper($matches[1]);
                }, ucfirst($name_str));
            }
            $path = 'controller' . "/$name_str";
            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', 'app/' . $path);
        }
        return ['name' => $name, 'file' => $file, 'namespace' => $namespace];
    }

    protected function getServicesName($name): array
    {
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $controller_str = Util::guessPath(app_path(), 'Services') ?: 'Services';
            $file = app_path() . "/$controller_str/$name.php";
            $namespace = 'app\Services';
        } else {
            $name_str = substr($name, 0, $pos);
            if ($real_name_str = Util::guessPath(app_path(), $name_str)) {
                $name_str = $real_name_str;
            } else if ($real_section_name = Util::guessPath(app_path(), strstr($name_str, '/', true))) {
                $upper = strtolower($real_section_name[0]) !== $real_section_name[0];
            } else if ($real_base_controller = Util::guessPath(app_path(), 'Services')) {
                $upper = strtolower($real_base_controller[0]) !== $real_base_controller[0];
            }
            $upper = $upper ?? strtolower($name_str[0]) !== $name_str[0];
            if ($upper && !$real_name_str) {
                $name_str = preg_replace_callback('/\/([a-z])/', function ($matches) {
                    return '/' . strtoupper($matches[1]);
                }, ucfirst($name_str));
            }
            $path = 'Services' . "/$name_str";
            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', 'app/' . $path);
        }
        return ['name' => $name, 'file' => $file, 'namespace' => $namespace];
    }

    protected function getModelName($name): array
    {
        if (!($pos = strrpos($name, '/'))) {
            $name = ucfirst($name);
            $model_str = Util::guessPath(app_path(), 'model') ?: 'model';
            $file = app_path() . "/$model_str/$name.php";
            $namespace = 'app\model';
        } else {
            $name_str = substr($name, 0, $pos);
            if ($real_name_str = Util::guessPath(app_path(), $name_str)) {
                $name_str = $real_name_str;
            } else if ($real_section_name = Util::guessPath(app_path(), strstr($name_str, '/', true))) {
                $upper = strtolower($real_section_name[0]) !== $real_section_name[0];
            } else if ($real_base_controller = Util::guessPath(app_path(), 'controller')) {
                $upper = strtolower($real_base_controller[0]) !== $real_base_controller[0];
            }
            $upper = $upper ?? strtolower($name_str[0]) !== $name_str[0];
            if ($upper && !$real_name_str) {
                $name_str = preg_replace_callback('/\/([a-z])/', function ($matches) {
                    return '/' . strtoupper($matches[1]);
                }, ucfirst($name_str));
            }
            $path = "$name_str/" . 'model';
            $name = ucfirst(substr($name, $pos + 1));
            $file = app_path() . "/$path/$name.php";
            $namespace = str_replace('/', '\\', 'app/' . $path);
        }
        return ['name' => $name, 'file' => $file, 'namespace' => $namespace];
    }
}
