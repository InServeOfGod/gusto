<?php

class DatabaseDeleter
{
    private Database $database;
    private PDO $pdo;

    public function __construct(Database $database)
    {
        $this->database = $database;
        $this->pdo = $database->getPdo();
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
     * @param string $query
     * @param int $id
     * @return bool|false
     */
    private function executor(string $query, int $id): bool
    {
        $stmt = $this->pdo->prepare($query);

        if ($stmt) {
            return $stmt->execute([$id]);
        }

        return false;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function about(int $id): bool
    {
        return $this->executor("DELETE FROM about WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function chef(int $id): bool
    {
        return $this->executor("DELETE FROM chef WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function contact(int $id): bool
    {
        return $this->executor("DELETE FROM contact WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function contactInfo(int $id): bool
    {
        return $this->executor("DELETE FROM contact_info WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function gallery(int $id): bool
    {
        return $this->executor("DELETE FROM gallery WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function header(int $id): bool
    {
        return $this->executor("DELETE FROM header WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function menus(int $id): bool
    {
        return $this->executor("DELETE FROM menus WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function menu_types(int $id): bool
    {
        return $this->executor("DELETE FROM menu_types WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function social_media(int $id): bool
    {
        return $this->executor("DELETE FROM social_media WHERE id = ?", $id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function specials(int $id): bool
    {
        return $this->executor("DELETE FROM specials WHERE id = ?", $id);
    }
}
