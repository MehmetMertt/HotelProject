DROP TABLE IF EXISTS users;
CREATE TABLE users(
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    mail VARCHAR(100),
    vname VARCHAR(100),
    nname VARCHAR(100),
    geschlecht CHAR(1),
    passwort VARCHAR(50),
    adresse VARCHAR(100),
    stadt VARCHAR(100),
    bundesland VARCHAR(100),
    plz VARCHAR(10),
    isAdmin INTEGER(1) CHECK (isAdmin = 0 OR isAdmin = 1)
);
INSERT INTO users(mail, vname, nname, geschlecht, passwort, adresse, stadt, bundesland, plz, isAdmin) VALUES (
    'admin@admin.com',
    'Mehmet',
    'Mert',
    'm',
    'test',
    'Ringstraße 01 8',
    'Wien',
    'Wien',
    '1010',
    1
);

INSERT INTO users(mail, vname, nname, geschlecht, passwort, adresse, stadt, bundesland, plz, isAdmin) VALUES (
    'admin2@admin.com',
    'John',
    'Doe',
    'm',
    'password',
    '123 Main St',
    'Berlin',
    'Berlin',
    '10115',
    1
);

INSERT INTO users(mail, vname, nname, geschlecht, passwort, adresse, stadt, bundesland, plz, isAdmin) VALUES (
    'user@user.com',
    'Jane',
    'Doe',
    'w',
    'password',
    '456 Elm St',
    'Hamburg',
    'Hamburg',
    '20095',
    0
);

