<?php

class DatabaseImager
{
    private Database $database;
    private string $path;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return Database
     */
    public function getDatabase(): Database
    {
        return $this->database;
    }

    /**
     * @param Database $database
     */
    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function image(string $data, string $path): bool
    {
        $this->path = $path;
        $f = fopen($path, 'wb');

        if ($f) {
            fwrite($f, $data);
            fclose($f);
            return true;
        }

        return false;
    }
}
