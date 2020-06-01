<?php
class Tag
{
  private $db;
  public function __construct()
  {
    $this->db = new Database();
  }


  public function getAllTags()
  {
    $this->db->query('SELECT * FROM tags ORDER BY created_at DESC');
    $tags = $this->db->getAll();
    if ($this->db->rowCount() > 0) {
      return $tags;
    } else {
      return false;
    }
  }

  public function getTagPosts($id){
    $this->db->query('SELECT posts.id AS postId,
							 posts.user_id as userId,
							 users.name AS userName,
							 posts.created_at AS postCreated,
							 posts.title AS postTitle,
							 posts.content AS PostContent,
							 tags.name AS tagName
							 FROM post_tags, posts, tags, users WHERE post_tags.post_id = posts.id
							 AND post_tags.tag_id=:id
							 AND tags.id=:id
							 AND posts.user_id = users.id
							 ORDER BY posts.created_at DESC');
    $this->db->bind(':id', $id);
    $posts = $this->db->getAll();
    if ($this->db->rowCount() > 0) {
      return $posts;
    } else {
      return false;
    }
  }

  public function getTagById($id) {
    $this->db->query('SELECT tag_id, name AS tag_name 
                      FROM post_tags
                      INNER JOIN posts
                      ON posts.id=post_tags.post_id
                      INNER JOIN tags
                      ON tags.id=post_tags.tag_id
                      WHERE post_id=:id'
    );
    $this->db->bind(':id', $id);
    $tagGroup = $this->db->getAll();
    if ($this->db->rowCount() > 0) {
      return $tagGroup;
    } else {
      return false;
    }
  }
}