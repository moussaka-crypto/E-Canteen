USE emensawerbeseite;

CREATE TABLE IF NOT EXISTS bewertung(
    bewertung_id INT(8) AUTO_INCREMENT PRIMARY KEY ,
    benutzer_id INT(8),
    gericht_id INT(8),
    description VARCHAR(800),
    stern VARCHAR(800),
    datum DATETIME,
    hervorgehoben BOOLEAN DEFAULT false,
    FOREIGN KEY (benutzer_id) REFERENCES benutzer(id) ON DELETE CASCADE ,
    FOREIGN KEY (gericht_id) REFERENCES  gericht(id) ON DELETE  CASCADE
);
