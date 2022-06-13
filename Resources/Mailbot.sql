DROP TABLE usermails;
/

CREATE TABLE usermails
(
  user_email VARCHAR(320),
  subject VARCHAR2(103),
  content_email VARCHAR(500),
  published NUMBER(1),
  CONSTRAINT check_yesno CHECK (published IN (0,1))
)
/

select * from usermails;