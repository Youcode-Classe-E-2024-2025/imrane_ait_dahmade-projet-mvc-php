-- Active: 1738801849361@@127.0.0.1@5432@test
CREATE Table "User" (
    id  BIGSERIAL PRIMARY KEY , 
    name VARCHAR(255) NOT NULL ,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insérer des données fictives dans la table User
INSERT INTO "User" (name, email, password) VALUES
    ('John Doe', 'john.doe@example.com', 'hashed_password_1'),
    ('Jane Smith', 'jane.smith@example.com', 'hashed_password_2'),
    ('Alice Johnson', 'alice.johnson@example.com', 'hashed_password_3'),
    ('Bob Brown', 'bob.brown@example.com', 'hashed_password_4'),
    ('Charlie White', 'charlie.white@example.com', 'hashed_password_5');

SELECT * FROM USER 

