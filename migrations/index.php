<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Core\DB\Connection;

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__));
$dotenv->load();

class Migration
{
    const SCRIPT_DIR = __DIR__ . '/scripts';

    public function __construct()
    {
        $this->checkMigrationsTable();
        $this->runAllMigrations();
    }

    protected function runAllMigrations(): void
    {
        d('Fetching migrations...');

        $migrations = scandir(self::SCRIPT_DIR);
        $migrations = array_values(array_diff($migrations, ['.', '..', 'migrations.sql']));

        foreach ($migrations as $migration) {
            $table = preg_replace('/[\d_]+/i', '', $migration);
            if (!$this->migrationWasExecuted($table)) {
                d('Run [' . $table . ']..');
                $script = file_get_contents(self::SCRIPT_DIR . '/' . $migration);
                $query = Connection::connect()->prepare($script);
                $query->execute();

                d('[' . $table . '] done!');

                $this->insertIntoMigrationsTable($table);
            }
        }

        d('Fetching migrations - done!');
    }

    protected function migrationWasExecuted(string $migration): bool
    {
        $query = Connection::connect()->prepare('SELECT * FROM migrations WHERE name=:name');

        $query->execute([
            'name' => $migration
        ]);

        return (bool)$query->fetch();
    }

    protected function insertIntoMigrationsTable(string $migration): void
    {
        $query = Connection::connect()->prepare('INSERT INTO migrations (name) VALUES (:name)');
        $query->execute([
            'name' => $migration
        ]);
    }

    protected function checkMigrationsTable(): void
    {
        $query = Connection::connect()->prepare("SHOW TABLES LIKE 'migrations'");
        $query->execute();
        if (!$query->fetch()) {
            d('Migrations table does not exist');
            d('Attempt to create...');
            $this->createMigrationsTable();
        }
    }

    protected function createMigrationsTable(): void
    {
        $script = file_get_contents(self::SCRIPT_DIR . '/migrations.sql');
        $query = Connection::connect()->prepare($script);

        $query->execute();
        d('Migrations table was created!');
    }
}

try {
    new Migration();

} catch (PDOException $exception) {
    dd($exception->getMessage());
}
