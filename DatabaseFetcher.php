<?php

class DatabaseFetcher {
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
     * @param bool $many
     * @return array|false
     */
    private function fetcher(string $query, bool $many = false) {
        $stmt = $this->pdo->prepare($query);

        if ($stmt) {
            $res = $stmt->execute();

            if ($res) {
                return ($many) ? $stmt->fetchAll() : $stmt->fetch();
            }
        }

        return false;
    }

    /**
     * @return void
     */
    public function about() {
        $this->database->setAbout($this->fetcher("SELECT * FROM about LIMIT 1"));
    }

    /**
     * @return void
     */
    public function chef() {
        $this->database->setChef($this->fetcher("SELECT * FROM chef LIMIT 1"));
    }

    /**
     * @return void
     */
    public function contact() {
        $this->database->setContact($this->fetcher("SELECT * FROM contact", true));
    }

    /**
     * @return void
     */
    public function contactInfo() {
        $this->database->setContactInfo($this->fetcher("SELECT * FROM contact_info LIMIT 1"));
    }

    /**
     * @return void
     */
    public function gallery() {
        $this->database->setGallery($this->fetcher("SELECT * FROM gallery LIMIT 4", true));
    }

    /**
     * @return void
     */
    public function header() {
        $this->database->setHeader($this->fetcher("SELECT * FROM header LIMIT 1"));
    }

    /**
     * @return void
     */
    public function menus() {
        $this->database->setMenus($this->fetcher("SELECT mt.menu_type, m.title, m.description, m.price FROM menus m JOIN menu_types mt on mt.id = m.menu_type_id", true));
    }

    /**
     * @return void
     */
    public function menu_types() {
        $this->database->setMenuTypes($this->fetcher("SELECT menu_type FROM menu_types", true));
    }

    /**
     * @return void
     */
    public function social_media() {
        $this->database->setSocialMedia($this->fetcher("SELECT * FROM social_media LIMIT 1"));
    }

    /**
     * @return void
     */
    public function specials() {
        $this->database->setSpecials($this->fetcher("SELECT * FROM specials LIMIT 3", true));
    }

    /**
     * @return void
     */
    public function user() {
        $this->database->setUser($this->fetcher("SELECT * FROM user LIMIT 1"));
    }

    /**
     * @param string $type
     * @return void
     */
    public function menus_by_type(string $type) {
        $this->database->setMenus($this->fetcher("SELECT m.title, m.description, m.price FROM menus m JOIN menu_types mt on mt.id = m.menu_type_id WHERE mt.menu_type = '$type'", true));
    }

    public function all() {
        $this->about();
        $this->chef();
        $this->contact();
        $this->contactInfo();
        $this->gallery();
        $this->header();
//        $this->menus();
        $this->menu_types();
        $this->social_media();
        $this->specials();
        $this->user();
    }
}
