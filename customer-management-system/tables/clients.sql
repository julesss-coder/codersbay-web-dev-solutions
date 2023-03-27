--  company_id, company_name, contact_person, phone, adress, created_by (welcher User hat den Eintrag erstellt), created_at(Erstelldatum), edited_at(Bearbeitungsdatum)
CREATE TABLE clients (
  company_id int NOT NULL,
  company_name varchar(255) NOT NULL,
  contact_person varchar(255),
  phone varchar(255),
  address varchar(255),
  created_by int, -- user_id
  created_at date,
  edited_at date,
  PRIMARY KEY (company_id),
  FOREIGN KEY (created_by) REFERENCES users(user_id)
);

INSERT INTO clients
VALUES (1, "Armani", "Giorgi Armani", 123456789, "Union Street 1, London", 1, 2023-03-23, 2023-03-23);

INSERT INTO clients
VALUES (2, "Benneton", "Mr. Benneton", 123456789, "Union Square 1, new York", 2, 2023-03-21, 2023-03-23);

INSERT INTO clients
VALUES (3, "Hofer", "Hermann Armani", 12345123456789, "Stephansplatz 1, 1010 Wien", 1, 2022-03-01, 2022-03-23);

INSERT INTO clients
VALUES (4, "CodersBay", "Stefan Stanzl", 123456789, "Peter-Behrens-PLatz 1, 4030 Linz", 3, 2020-01-01, 2023-01-13);