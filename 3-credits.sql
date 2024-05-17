-- Lets we define the `credits` table as 
CREATE TABLE credits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    balance DECIMAL(10, 2) NOT NULL,
    created DATETIME NOT NULL
);
-- Let's we feed the `credits` table some dummy sample data as
INSERT INTO credits (user_id, balance, created) VALUES
(1, 100.00, '2022-12-30 10:00:00'),
(1, 150.00, '2022-12-31 15:00:00'),
(1, 200.00, '2023-01-01 10:00:00'),
(2, 200.00, '2022-12-28 09:00:00'),
(2, 250.00, '2022-12-31 17:00:00'),
(3, 300.00, '2022-12-31 23:59:00'),
(3, 350.00, '2023-01-01 12:00:00');

-- So now SQL Query to Retrieve Last Credit Balance on 31st December 2022 might be like.

SELECT c.user_id, c.balance AS last_credit_balance
FROM credits c
INNER JOIN (
    SELECT user_id, MAX(created) AS last_created
    FROM credits
    WHERE created <= '2022-12-31 23:59:59'
    GROUP BY user_id
) AS latest_credit ON c.user_id = latest_credit.user_id AND c.created = latest_credit.last_created;