DROP TABLE friendsmails
/
DROP TABLE usermails
/
DROP TABLE users
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
  privacy VARCHAR2(10),
  password VARCHAR2(100),
  duration DATE,
  CONSTRAINT check_yesno CHECK (published IN (0,1))
)
/

CREATE TABLE friendsmails(
    user_email VARCHAR2(320) NOT NULL,
    subject VARCHAR2(103),
    content_email VARCHAR2(500)
)
/
