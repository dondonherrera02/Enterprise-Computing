USE todofs2;

CREATE TABLE tasks (
    id INT(11) NOT NULL AUTO_INCREMENT,
    task VARCHAR(255) NOT NULL,
    is_completed TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

INSERT INTO tasks (task, is_completed) VALUES
('Call mom', 1),
('Plan weekend trip', 0),
('Read a book', 1),
('Attend yoga class', 0),
('Fix the leaking faucet', 0),
('Prepare presentation slides', 1),
('Organize desk drawer', 0),
('Schedule dentist appointment', 0);