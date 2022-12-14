USE emensawerbeseite;

CREATE PROCEDURE anmeldungInkrementieren(
IN input_id INT8,
IN input_email VARCHAR(100))
BEGIN
    UPDATE benutzer
    SET anzahlAnmeldungen = anzahlAnmeldungen + 1
    WHERE benutzer.id = input_id AND benutzer.email = input_email;
END;