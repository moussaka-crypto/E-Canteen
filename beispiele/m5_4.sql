USE emensawerbeseite;

CREATE VIEW IF NOT EXISTS view_suppengerichte AS
SELECT name FROM gericht
WHERE name LIKE '%suppe%';

CREATE VIEW IF NOT EXISTS  view_anmeldungen AS
SELECT anzahlAnmeldungen FROM benutzer
ORDER BY anzahlAnmeldungen DESC;

CREATE VIEW IF NOT EXISTS view_kategoriegerichte_vegetarisch AS
SELECT GROUP_CONCAT(g.name) AS gerichtname, k.name AS kategoriename
FROM gericht g RIGHT JOIN gericht_hat_kategorie ghk ON g.id = ghk.gericht_id AND vegetarisch = 1
               RIGHT JOIN kategorie k ON ghk.kategorie_id = k.id
GROUP BY k.name;