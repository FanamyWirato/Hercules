<?php
namespace Repository;

class RepositoryPost{
	/**
	 *
	 * @var \PDO
	 */
	private $cube;
	/**
	 *
	 * @var \Core\Post[]
	 */
	private $postList = array();

	/* Dependency Injection */
	public function __construct(\PDO $cube){
		$this->cube = $cube;
	}

	public function save(\Core\Post $post){
		if($post->getID()){
			//Update
			$stmt = $this->cube->prepare("UPDATE posts SET title = :title, text = :text WHERE post_ID = :id");
			$stmt->bindValue(':title', $post->getTitle());
			$stmt->bindValue(':text', $post->getText());
			$stmt->bindValue(':id', $post->getID());
			$stmt->execute();
		} else {
			//Create
			$stmt = $this->cube->prepare("INSERT INTO posts (title, date, text, author) VALUES (:title, :date, :text, :author)");
			$stmt->bindValue(':title', $post->getTitle());
			$stmt->bindValue(':date', $post->getDate()->format("Y-m-d H:i:s"));
			$stmt->bindValue(':text', $post->getText());
			$stmt->bindValue(':author', $post->getAuthor()->getID());
			$stmt->execute();
			
		}
	}

	public function delete($id){
		$stmt = $this->cube->prepare("DELETE FROM posts WHERE post_ID = :id");
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}
	public function getById($id){
		// pleaseeee check if caching works :)
		if(!empty($this->postList[$id])){
			return $this->postList[$id];
		} else {
			$stmt = $this->cube->prepare("SELECT * FROM posts WHERE post_ID = :id");
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			if($stmt->rowCount() == 0){
				return false;
			}
			$dbPost = $stmt->fetchObject();
			$this->postList[$dbPost->post_ID] = new \Core\Post($dbPost);
			return $this->postList[$dbPost->post_ID];
		}		
	}
	public function getAll(){
		$stmt = $this->cube->prepare("SELECT * FROM posts ORDER BY date DESC");
		$stmt->execute();
		while ($post = $stmt->fetchObject()){
			if(empty($this->postList[$post->post_ID])){
				$this->postList[$post->post_ID] = new \Core\Post($post); 
			}
			yield $this->postList[$post->post_ID];
		}
	}
}