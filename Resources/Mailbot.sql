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

drop table viewdata;
/
create table viewdata(
    postid varchar2(500) not null,
    country varchar2(32) not null,
    timestmp date not null    
);
/

create or replace procedure get_last_viewed(post_id varchar2,last_date out varchar2) is
    tmp varchar2(32);
begin
    execute immediate 'ALTER SESSION SET NLS_DATE_FORMAT = ''YYYY-MM-DD HH24:MI''';
    select max(timestmp)||'' into tmp from viewdata where postid = post_id;
    last_date:=tmp;
end;
/

create or replace procedure add_view(post_id varchar2,country varchar2,debg out number) is
    tmp varchar(128);
begin
    insert into viewdata values(post_id,country,sysdate);  
    debg:=-1;
end;
/
create or replace type str_table is table of varchar2(128);
/

create or replace procedure get_stats(post_id varchar2,timescale number,x_ret out str_table) is
    diff number := 0; --measures seconds
begin
    x_ret := str_table();
    --execute immediate 'ALTER SESSION SET NLS_DATE_FORMAT = ''YYYY-MM-DD HH24:MI::SS''';
    if timescale=1 then
        diff := 60*60;
    elsif timescale=2 then
        diff := 60*60*24;
    elsif timescale=3 then
        diff := 60*60*24*7;
    elsif timescale=4  then
        diff := 60*60*24*30;
    elsif timescale=5  then
        diff := 60*60*24*365;
    end if;
    
    if diff !=0 then
        execute immediate 'ALTER SESSION SET NLS_DATE_FORMAT = ''YYYY-MM-DD HH24:MI:SS''';
        select timestmp||'#'||country bulk collect into x_ret from viewdata where post_id=postid and abs(timestmp-sysdate)*24*60*60 < diff;
    end if;
end;
/


ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI::SS';
select * from viewdata;

CREATE TABLE friendsmails(
    user_email VARCHAR2(320) NOT NULL,
    content_email VARCHAR2(500),
    CONSTRAINT fk_user_friend FOREIGN KEY(user_email) references users(email),
    CONSTRAINT fk_content_friend FOREIGN KEY(content_email) references usermails(content_email),
    CONSTRAINT unique_user_mail UNIQUE (user_email,content_email)
)
/

ALTER DATABASE SET TIME_ZONE = '+00:00';

select * from usermails;
select * from friendsmails;

DELETE FROM FRIENDSMAILS;
delete from usermails;
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa!','emailpublisher1@gmail.com_1.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa2!','emailpublisher1@gmail.com_2.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa3!','emailpublisher1@gmail.com_3.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa4!','emailpublisher1@gmail.com_4.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa5!','emailpublisher1@gmail.com_5.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa6!','emailpublisher1@gmail.com_6.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa7!','emailpublisher1@gmail.com_7.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('emailpublisher1@gmail.com','Vacanta frumoasa8!','emailpublisher1@gmail.com_8.html',0);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('dimitriu.corina@gmail.com','Vacanta frumoasa10!','dimitriu.corina@gmail.com_1.html',1);
INSERT INTO USERMAILS(user_email,subject,content_email,published) VALUES('corina.dimitriu.01@gmail.com','Vacanta frumoasa11!','corina.dimitriu.01@gmail.com_1.html',1);
commit;

select TO_CHAR(duration,'YYYY-MM-DD HH24:MI:SS') from usermails;

INSERT INTO friendsmails VALUES('emailpublisher1@gmail.com','dimitriu.corina@gmail.com_1.html');
INSERT INTO friendsmails VALUES('emailpublisher1@gmail.com','corina.dimitriu.01@gmail.com_1.html');
SELECT * FROM (SELECT ROWNUM rn,unu,doi,trei FROM (SELECT u.user_email unu,u.subject doi,u.content_email trei FROM friendsmails f JOIN usermails u ON f.content_email = u.content_email WHERE u.user_email = 'dimitriu.corina@gmail.com' AND f.user_email = 'emailpublisher1@gmail.com' AND published = 1 ORDER BY f.content_email DESC) t) WHERE rn < 7 AND rn > 0;