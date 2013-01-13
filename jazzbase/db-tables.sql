DROP TABLE singers;
DROP TABLE albums;
DROP TABLE styles;
DROP TABLE instruments;
DROP TABLE singer_styles;
DROP TABLE singer_instruments;
DROP TABLE see_also_singers;

CREATE TABLE singers(
  sgr_id      INT AUTO_INCREMENT NOT NULL,
  sgr_name    VARCHAR(150),
  sgr_descr   TEXT,
  PRIMARY KEY(sgr_id));

ALTER TABLE singers
  AUTO_INCREMENT=100000;

CREATE TABLE albums(
  alb_id      INT AUTO_INCREMENT NOT NULL,
  jb_id       INT NOT NULL DEFAULT 0,
  sgr_id      INT NOT NULL,
  alb_type    TINYINT DEFAULT 0,
  alb_name    VARCHAR(150),
  alb_year    YEAR,
  alb_descr   TEXT,
  PRIMARY KEY(alb_id),
  FOREIGN KEY(sgr_id) REFERENCES singers(sgr_id));

ALTER TABLE albums
  ADD INDEX (jb_id);

CREATE TABLE styles(
  stl_id     INT AUTO_INCREMENT NOT NULL,
  stl_name   VARCHAR(150),
  PRIMARY KEY(stl_id));

CREATE TABLE singer_styles(
  sst_id   INT AUTO_INCREMENT NOT NULL,
  stl_id   INT NOT NULL,
  sgr_id   INT NOT NULL,
  FOREIGN KEY(stl_id) REFERENCES styles(stl_id),
  FOREIGN KEY(sgr_id) REFERENCES singers(sgr_id),
  PRIMARY KEY(sst_id));

CREATE TABLE instruments(
  ins_id     INT AUTO_INCREMENT NOT NULL,
  ins_name   VARCHAR(150),
  PRIMARY KEY(ins_id));

CREATE TABLE singer_instruments(
  sin_id   INT AUTO_INCREMENT NOT NULL,
  ins_id   INT NOT NULL,
  sgr_id   INT NOT NULL,
  FOREIGN KEY(ins_id) REFERENCES instruments(ins_id),
  FOREIGN KEY(sgr_id) REFERENCES singers(sgr_id),
  PRIMARY KEY(sin_id));

CREATE TABLE singers_see_also(
  sas_id     INT AUTO_INCREMENT NOT NULL,
  sgr_id     INT NOT NULL,
  seealso_id INT NOT NULL,
  PRIMARY KEY(sas_id),
  FOREIGN KEY(sgr_id) REFERENCES singers(sgr_id),
  FOREIGN KEY(seealso_id) REFERENCES singers(seealso_id));