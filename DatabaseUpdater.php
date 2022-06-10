<?php

class DatabaseUpdater
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
     * @param array $params
     * @return bool|false
     */
    private function executor(string $query, array $params): bool
    {
        $stmt = $this->pdo->prepare($query);

        if ($stmt) {
            return $stmt->execute($params);
        }

        return false;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function about(array $data): bool
    {
        return $this->executor("UPDATE about SET story = ?, photo = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function chef(array $data): bool
    {
        return $this->executor("UPDATE chef SET title = ?, description = ?, photo = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function contact(array $data): bool
    {
        return $this->executor("UPDATE contact SET name = ?, email = ?, msg = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function contactInfo(array $data): bool
    {
        return $this->executor("UPDATE contact_info SET phone_number = ?, address = ?, week_work_from = ?, week_work_to = ?, weekend_work_from = ?, weekend_work_to = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function gallery(array $data): bool
    {
        return $this->executor("UPDATE gallery SET photo = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function header(array $data): bool
    {
        return $this->executor("UPDATE header SET title = ?, photo = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function menus(array $data): bool
    {
        return $this->executor("UPDATE menus SET menu_type_id = ?, title = ?, description = ?, price = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function menu_types(array $data): bool
    {
        return $this->executor("UPDATE menu_types SET menu_type = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function social_media(array $data): bool
    {
        return $this->executor("UPDATE social_media SET facebook = ?, instagram = ?, youtube = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function specials(array $data): bool
    {
        return $this->executor("UPDATE specials SET title = ?, photo = ?, description = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function user(array $data): bool
    {
        return $this->executor("UPDATE user SET username = ?, password = ?, updated_at = current_timestamp(), photo = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function profits(array $data): bool
    {
        return $this->executor("UPDATE profits SET profit = ?, loss = ?, day = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function todo(array $data): bool
    {
        return $this->executor("UPDATE todo_list SET todo = ?, done = ?, timestamp = ? WHERE id = ?", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function visitors(array $data): bool
    {
        return $this->executor("UPDATE visitors SET visitor_ip = ? WHERE id = ?", $data);
    }
}
