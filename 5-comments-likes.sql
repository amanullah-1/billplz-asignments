-- Lets we define the comments and likes tables as 
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    content TEXT NOT NULL
);

CREATE TABLE likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    comment_id INT NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (comment_id) REFERENCES comments(id)
);

-- Lets we feed the table with some dummy data as 
INSERT INTO comments (user_id, content) VALUES
(1, 'This is a comment by user 1'),
(2, 'This is a comment by user 2'),
(3, 'This is a comment by user 3');

INSERT INTO likes (comment_id, user_id) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 1);

-- So as per our tables defined the asking SQL statment might be like 

SELECT c.id AS comment_id, COUNT(l.user_id) AS like_count
FROM comments c
LEFT JOIN likes l ON c.id = l.comment_id
GROUP BY c.id;