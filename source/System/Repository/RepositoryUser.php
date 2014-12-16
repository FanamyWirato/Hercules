<?php
namespace Repository;

class RepositoryUser{
	/**
	 *
	 * @var \PDO
	 */
	private $cube;
	/**
	 *
	 * @var \Core\Post[]
	 */
	private $userList = array();

	/* Dependency Injection */
	public function __construct(\PDO $cube){
		$this->cube = $cube;
	}

	public function save(\Core\User $user){
		if($user->getID()){
			// Update
			$stmt = $this->cube->prepare("UPDATE users SET name = :name, authorName = :aName, pw = :pw WHERE user_ID = :id");
			$stmt->bindValue(':name', $user->getUsername());
			$stmt->bindValue(':aName', $user->getAuthorName());
			$stmt->bindValue(':pw', $user->getPassword());
			$stmt->bindValue(':id', $user->getID());
			$stmt->execute();
		} else {
			// Create
			$stmt = $this->cube->prepare("INSERT INTO users (name, authorName, pw, hash) VALUES (:name, :aName, :pw, :hash)");
			$stmt->bindValue(':name', $user->getUsername());
			$stmt->bindValue(':aName', $user->getAuthorName());
			$stmt->bindValue(':pw', $user->getPassword());
			$stmt->bindValue(':hash', $user->getHash());
			$stmt->execute();
		}
	}

	public function delete($id){
		// me neither Q.Q
	}
	/**
	 * 
	 * @param int $id
	 * @return boolean|\Core\User
	 */
	public function getById($id){
		// Check if caching works, pleaseeeeeeeeee just this one time....
		if(!empty($this->userList[$id])){
			return $this->userList[$id];
		} else {
			$stmt = $this->cube->prepare("SELECT * FROM users WHERE user_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			if($stmt->rowCount() == 0){
				return false;
			}
			$dbUser = $stmt->fetchObject();
			$this->userList[$dbUser->user_ID] = new \Core\User($dbUser);
			return $this->userList[$dbUser->user_ID];
		}		
	}
	public function getAll(){
		// u guys up there? you're not alone D:
	}
	
	//alterative -> Hash aus User Daten jedesmal erzeugen und mit Cookie abgleichen?
	public function getByCookieData($id, $hash){
		$stmt = $this->cube->prepare("SELECT * FROM users WHERE user_ID = :id AND hash = :hash");
		$stmt->bindValue(':id', $id);
		$stmt->bindValue(':hash', $hash);
		$stmt->execute();
		if($stmt->rowCount() == 0){
			return false;
		}
		$dbUser = $stmt->fetchObject();
		$user = new \Core\User($dbUser);
		\Repository\Factory::setUser($user);
		return $user;
	}
	
	public function getByPostData($username, $password){
		$stmt = $this->cube->prepare("SELECT * FROM users WHERE name = :username");
		$stmt->bindValue(':username', $username);
		$stmt->execute();
		if($stmt->rowCount() == 0){
			return false;
		}
		$dbUser = $stmt->fetchObject();
		$user = new \Core\User($dbUser);
		
		if(!$user->comparePw($password)){
			return false;
		}
		\Repository\Factory::setUser($user);
		return $user;
	}
}