DROP TABLE friendsmails;
/
DROP TABLE usermails;
/
DROP TABLE users;
/

CREATE TABLE users(
    email VARCHAR2(320) PRIMARY KEY,
    verification_code VARCHAR2(100)
)
/

CREATE TABLE usermails(
  user_email VARCHAR2(320),
  subject VARCHAR2(103),
  content_email VARCHAR2(500) PRIMARY KEY,
  published NUMBER(1) DEFAULT 0,
  privacy VARCHAR2(10) DEFAULT 'Public',
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

select * from usermails;

