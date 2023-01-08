CREATE TABLE IF NOT EXISTS Sternebewertung(
                                              id int primary key auto_increment ,
                                              bemerkung varchar(200) not null ,
                                              sternebewertung int not null,
                                              bewertungszeitpunkt datetime not null,
                                              hervorgehoben boolean default false,
                                              benutzer_fk int,
                                              gericht_fk int,
                                              check ( sternebewertung > 0 and sternebewertung < 5),
                                              check (length(bemerkung) > 4)
);

Alter TABLE sternebewertung add constraint benutzer_stbew
    FOREIGN KEY (benutzer_fk)
        references benutzer(id)
        on update cascade
        on delete cascade ;

Alter table sternebewertung add constraint gericht_stbew
    foreign key (gericht_fk)
        references gericht(id)
        on update cascade
        on delete cascade;

drop table if exists sternebewertung;