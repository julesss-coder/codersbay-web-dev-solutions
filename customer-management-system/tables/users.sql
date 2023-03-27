-- users: user_id, name, email, password
CREATE TABLE users (
  user_id int NOT NULL,
  name varchar(255) NOT NULL,
  email varchar(255),
  password varchar(255),
  PRIMARY KEY (user_id)
);

INSERT INTO users
VALUES (1, "Maria Mustermann", "maria.mustermann@hotmail.com", "passwort123");

INSERT INTO users
VALUES (2, "Max Mustermann", "max.mustermann@hotmail.com", "passwort123");

INSERT INTO users
VALUES (3, "Ingrid Bergman", "ingrid.bergman@bergman.com", "passwesfrsrtqort123");

INSERT INTO users
VALUES (4, "Marilyn Monroe", "normajeanbaker@gmail.com", "werthygjk");