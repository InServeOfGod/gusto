<?php

class DatabaseInserter
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
        return $this->executor("INSERT INTO about (story, photo) VALUES (?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function chef(array $data): bool
    {
        return $this->executor("INSERT INTO chef (title, description, photo) VALUES (?,?,?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function contact(array $data): bool
    {
        return $this->executor("INSERT INTO contact (name, email, msg) VALUES (?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function contactInfo(array $data): bool
    {
        return $this->executor("INSERT INTO contact_info (phone_number, address, week_work_from, week_work_to, weekend_work_from, weekend_work_to) VALUES (?, ?, ?, ?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function gallery(array $data): bool
    {
        return $this->executor("INSERT INTO gallery (photo) VALUES (?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function header(array $data): bool
    {
        return $this->executor("INSERT INTO header (title, photo) VALUES (?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function menus(array $data): bool
    {
        return $this->executor("INSERT INTO menus (menu_type_id, title, description, price) VALUES (?, ?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function menu_types(array $data): bool
    {
        return $this->executor("INSERT INTO menu_types (menu_type) VALUES (?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function social_media(array $data): bool
    {
        return $this->executor("INSERT INTO social_media (facebook, instagram, youtube) VALUES (?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function specials(array $data): bool
    {
        return $this->executor("INSERT INTO specials (title, photo, description) VALUES (?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function todo(array $data): bool
    {
        return $this->executor("INSERT INTO todo_list (todo, done, timestamp) VALUES (?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function profits(array $data): bool
    {
        return $this->executor("INSERT INTO profits (profit, loss, day) VALUES (?, ?, ?)", $data);
    }

    /**
     * @param array $data
     * @return bool
     */
    public function visitors(array $data): bool
    {
        return $this->executor("INSERT INTO visitors (visitor_ip) VALUES (?)", $data);
    }
}
