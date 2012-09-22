<?php
class Thread extends AppModel
{
    /**
     * get all thread
     * @return <Thread> array
     */
    public static function getAll()
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM thread');

        foreach ($rows as $row) {
            $threads[] = new Thread($row);
        }
        return $threads;
    }

    /**
     * get thread that find by id
     * @param string id
     * @return Thread
     */
    public static function get($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));
        return new self($row);
    }

    /**
     * get all comment that find by thread_id
     * @return <Comment> array
     */
    public function getComments()
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows(
            'SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC',
            array($this->id)
        );
        foreach ($rows as $row) {
            $comments[] = new Comment($row);
        }
        return $comments;
    }

    /**
     * write comment
     * @param Comment
     */
    public function write(Comment $comment)
    {
        if (!$comment->validate()) {
            throw new ValidationException('invalid comment');
        }

        $db = DB::conn();
        $db->query(
          'INSERT INTO comment SET thread_id = ?, username = ?, body = ?, created = NOW()',
            array($this->id, $comment->username, $comment->body)
        );
    }

}
