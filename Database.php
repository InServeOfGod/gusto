<?php


class Database {
    private array $about;
    private array $chef;
    private array $contact;
    private array $contact_info;
    private array $gallery;
    private array $header;
    private array $menus;
    private array $menu_types;
    private array $social_media;
    private array $specials;
    private array $user;
    private array $profits;
    private array $todo;
    private array $visitors;

    private string $error;
    private string $host;
    private PDO $pdo;
    private string $dsn;
    private string $dbname;
    private string $username;
    private string $password;

    public function __construct(string $dbname, string $username, string $password, string $host='localhost')
    {
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->host = $host;
        $this->dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            $this->pdo = new PDO($this->dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);

        } catch (PDOException $PDOException) {
            $this->error = $PDOException->getMessage();
        }
    }

    public function __destruct()
    {
        $this->about = [];
        $this->chef = [];
        $this->contact = [];
        $this->contact_info = [];
        $this->gallery = [];
        $this->header = [];
        $this->menus = [];
        $this->menu_types = [];
        $this->social_media = [];
        $this->specials = [];
        $this->user = [];

        $this->error = '';
        $this->host = '';
        $this->dsn = '';
        $this->dbname = '';
        $this->username = '';
        $this->password = '';
    }

    /**
     * @return array
     */
    public function getAbout(): array
    {
        return $this->about;
    }

    /**
     * @param array $about
     */
    public function setAbout(array $about): void
    {
        $this->about = $about;
    }

    /**
     * @return array
     */
    public function getChef(): array
    {
        return $this->chef;
    }

    /**
     * @param array $chef
     */
    public function setChef(array $chef): void
    {
        $this->chef = $chef;
    }

    /**
     * @return array
     */
    public function getContact(): array
    {
        return $this->contact;
    }

    /**
     * @param array $contact
     */
    public function setContact(array $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return array
     */
    public function getContactInfo(): array
    {
        return $this->contact_info;
    }

    /**
     * @param array $contact_info
     */
    public function setContactInfo(array $contact_info): void
    {
        $this->contact_info = $contact_info;
    }

    /**
     * @return array
     */
    public function getGallery(): array
    {
        return $this->gallery;
    }

    /**
     * @param array $gallery
     */
    public function setGallery(array $gallery): void
    {
        $this->gallery = $gallery;
    }

    /**
     * @return array
     */
    public function getHeader(): array
    {
        return $this->header;
    }

    /**
     * @param array $header
     */
    public function setHeader(array $header): void
    {
        $this->header = $header;
    }

    /**
     * @return array
     */
    public function getMenus(): array
    {
        return $this->menus;
    }

    /**
     * @param array $menus
     */
    public function setMenus(array $menus): void
    {
        $this->menus = $menus;
    }

    /**
     * @param array $menu_types
     */
    public function setMenuTypes(array $menu_types): void
    {
        $this->menu_types = $menu_types;
    }

    /**
     * @return array
     */
    public function getMenuTypes(): array
    {
        return $this->menu_types;
    }

    /**
     * @return array
     */
    public function getSocialMedia(): array
    {
        return $this->social_media;
    }

    /**
     * @param array $social_media
     */
    public function setSocialMedia(array $social_media): void
    {
        $this->social_media = $social_media;
    }

    /**
     * @return array
     */
    public function getSpecials(): array
    {
        return $this->specials;
    }

    /**
     * @param array $specials
     */
    public function setSpecials(array $specials): void
    {
        $this->specials = $specials;
    }

    /**
     * @return array
     */
    public function getUser(): array
    {
        return $this->user;
    }

    /**
     * @param array $user
     */
    public function setUser(array $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * @param PDO $pdo
     */
    public function setPdo(PDO $pdo): void
    {
        $this->pdo = $pdo;
    }

    /**
     * @return string
     */
    public function getDsn(): string
    {
        return $this->dsn;
    }

    /**
     * @param string $dsn
     */
    public function setDsn(string $dsn): void
    {
        $this->dsn = $dsn;
    }

    /**
     * @return string
     */
    public function getDbname(): string
    {
        return $this->dbname;
    }

    /**
     * @param string $dbname
     */
    public function setDbname(string $dbname): void
    {
        $this->dbname = $dbname;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    /**
     * @return array
     */
    public function getProfits(): array
    {
        return $this->profits;
    }

    /**
     * @param array $profits
     */
    public function setProfits(array $profits): void
    {
        $this->profits = $profits;
    }

    /**
     * @return array
     */
    public function getTodo(): array
    {
        return $this->todo;
    }

    /**
     * @param array $todo
     */
    public function setTodo(array $todo): void
    {
        $this->todo = $todo;
    }

    /**
     * @return array
     */
    public function getVisitors(): array
    {
        return $this->visitors;
    }

    /**
     * @param array $visitors
     */
    public function setVisitors(array $visitors): void
    {
        $this->visitors = $visitors;
    }
}
