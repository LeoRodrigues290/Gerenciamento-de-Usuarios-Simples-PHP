CREATE TABLE usuarios (
id INT AUTO_INCREMENT PRIMARY KEY, -- ID único.
email VARCHAR(255) NOT NULL UNIQUE, -- Email do usuário.
senha VARCHAR(255) NOT NULL -- Senha criptografada.
);