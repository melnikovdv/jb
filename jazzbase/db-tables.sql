CREATE TABLE test.singer (
   sgr_id INT AUTO_INCREMENT NOT NULL,   
   sgr_name VARCHAR(150),
   sgr_descr TEXT,
  PRIMARY KEY (sgr_id)
);

ALTER TABLE test.singer 
  AUTO_INCREMENT=100000;

CREATE TABLE test.album (
  alb_id INT AUTO_INCREMENT NOT NULL,    
  jb_id INT NOT NULL DEFAULT 0,
  sgr_id INT NOT NULL,
  alb_type TINYINT DEFAULT 0,
  alb_name VARCHAR(150),
  alb_year YEAR,
  alb_descr TEXT,
  PRIMARY KEY (alb_id),
  FOREIGN KEY (sgr_id) REFERENCES singers(sgr_id)
);

ALTER TABLE test.album
  ADD INDEX (jb_id);

  delete from singer;
delete from album;