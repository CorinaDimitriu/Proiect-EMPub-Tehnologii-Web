DROP TABLE usermails;
/

DROP TABLE users;
/

CREATE TABLE users(
    email VARCHAR2(320) PRIMARY KEY NOT NULL,
    verification_code NUMBER(4)
)
/

CREATE TABLE usermails(
  user_email VARCHAR2(320),
  subject VARCHAR2(103),
  content_email VARCHAR2(500),
  published NUMBER(1),
  CONSTRAINT check_yesno CHECK (published IN (0,1))
)
/
