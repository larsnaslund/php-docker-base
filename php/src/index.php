<?php
declare(strict_types=1);

spl_autoload_register(static function ($className) {
    $folderPath = 'classes/';
    $filePath = $folderPath . $className . '.php';

    if (!file_exists($filePath)) {
        return false;
    }
    require_once($filePath);
});


try {

    // Replace this with environment variables once you know everything works
    // The user and database is created with a schema which can be found at ../../database/schema.sql
    $user = 'testuser';
    $password = 'password';
    $host = 'host.docker.internal:6033';
    $database = 'test_database';
    $charset = 'utf8mb4';

    $db = new PDO('mysql:host=' . $host . ';dbname=' . $database . ';charset=' . $charset, $user, $password);

    // Testing the autoloader
    $test = new TestClass();
    $test->printMessage("<p>Database connection established. Let's fetch some rows.</p>");
    $rows = $db->query('SELECT `title`, `text` FROM `notes`')->fetchAll(PDO::FETCH_OBJ);

    if (!$rows) {
        throw new \RuntimeException("Looks like we weren't able to fetch anything from the notes table.");
    }

    foreach ($rows as $row) {
        // Let's print some ugly inline html
        echo "<div style='border:1px solid #000; background: #EEE; padding:16px;margin-bottom:16px;'>";
        echo "<div><strong>{$row->title}</strong></div>";
        echo "<p>{$row->text}</p>";
        echo "</div>";
    }

    $test->printMessage("<p>Below we'll trigger an error to make sure strict types work.</p>");

    // This should cause an error because of strict types
    $test->setInt('string');

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
} catch (TypeError $e) {
    echo "<code>{$e->getMessage()}</code>";
} catch (Exception $e) {
    echo "<code>{$e->getMessage()}</code>";
}