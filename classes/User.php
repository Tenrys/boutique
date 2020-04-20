<?php

class User extends ShopItem {
	protected static Array $cache = [];
	protected static string $table = "users";

	protected string $firstName;
	protected string $lastName;
	protected string $email;
	protected string $password;
	protected int $rank;
	protected DateTime $birthday;

	protected static Array $sqlMap = [
		"firstName" => "firstname",
		"lastName" => "lastname"
	];

	public static function Register(Array $data) {
		$fields = [
			"lastname" => true,
			"firstname" => true,
			"email" => true,
			"password" => true,
			"birthday" => true,
			"passwordConfirm" => true
		];

		foreach (array_keys($fields) as $field) {
            if (!isset($data[$field])) return [false, "Champ '$field' manquant", null];
        }

		if (User::Get(["email" => $data["email"]])) {
			return [false, "Cette adresse e-mail est déjà utilisée par un autre utilisateur", null];
		}

		if ($data["password"] !== $data["passwordConfirm"]) {
			return [false, "Veuillez confirmer votre mot de passe correctement", null];
		}

		// On ne veut que les valeurs qui nous concernent... Car n'importe qui peut mettre n'importe quoi dans son POST !
		unset($data["passwordConfirm"]);
		$data = array_intersect_key($data, $fields);

		$user = new User($data);
		$user->setPassword($data["password"]); // Cryptage du mot de passe
		User::Insert($user);

		return [true, "Inscription réussie", $user];
	}

	public static function Login(string $email, string $password) {
		if (!$email) { // Le champ peut être vide ...
			return [false, "Champ 'email' manquant", null];
		}
		if (!$password) {
			return [false, "Champ 'password' manquant", null];
		}
		if (($user = User::Get(["email" => $email])) && password_verify($password, $user->getPassword())) {
			return [true, "", $user];
		}
		return [false, "Mot de passe incorrect", null]; // On ne fait pas savoir si un compte existe à l'adresse e-mail renseignée
	}

	function __construct(Array $data = []) {
		parent::__construct($data);

		$this->setFirstName($data["firstname"] ?? "");
		$this->setLastName($data["lastname"] ?? "");
		$this->setEmail($data["email"] ?? "");
		$this->setPassword($data["password"] ?? "", false); // On recrée seulement un mot de passe si besoin
		$this->setRank($data["rank"] ?? 0);
		$this->setBirthday($data["birthday"] ?? new DateTime());
	}

	public function getFirstName() { return $this->firstName; }
	public function getLastName() { return $this->lastName; }
	public function getEmail() { return $this->email; }
	public function getPassword() { return $this->password; }
	public function getRank() { return $this->rank; }
	public function getBirthday() { return $this->birthday; }

	public function setFirstName(string $firstName) { $this->firstName = $firstName; }
	public function setLastName(string $lastName) { $this->lastName = $lastName; }
	public function setEmail(string $email) { $this->email = $email; }
	public function setPassword(string $password, bool $hash = false) {
		if ($hash) {
			$password = password_hash($password, PASSWORD_BCRYPT);
		}
		$this->password = $password;
	}
	public function setRank(int $rank) { $this->rank = $rank; }
	public function _setBirthday($date) { $this->birthday = $date; }
	public function setBirthday($date) { _set_item_date($this, "_setBirthday", $date); }

	public function getFullName() { return $this->firstName . " " . $this->lastName; }
}
