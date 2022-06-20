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
  CONSTRAINT check_yesno CHECK (published IN (0,1)),
  CONSTRAINT fk_user FOREIGN KEY(user_email) references users(email)
)
/

CREATE TABLE friendsmails(
    user_email VARCHAR2(320) NOT NULL,
    content_email VARCHAR2(500),
    CONSTRAINT fk_user_friend FOREIGN KEY(user_email) references users(email),
    CONSTRAINT fk_content_friend FOREIGN KEY(content_email) references usermails(content_email),
    CONSTRAINT unique_user_mail UNIQUE (user_email,content_email)
)
/

