drop table viewdata;
create table viewdata(
    postid varchar2(500) not null,
    country varchar2(32) not null,
    timestmp date not null    
);

create or replace procedure add_view(post_id varchar2,country varchar2) is
    tmp varchar(128);
begin
    select 'insert into viewdata values('''||post_id||''','''||country||''',sysodedate)' into tmp from dual;
    dbms_output.put_line(tmp);
    execute immediate tmp;
end;

create or replace type str_table is table of varchar2(128);



create or replace procedure get_stats(post_id varchar2,timescale number,x_ret out str_table) is
    diff number; --measures seconds
begin
    dbms_output.put_line('hi');
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
    
    execute immediate 'ALTER SESSION SET NLS_DATE_FORMAT = ''YYYY-MM-DD HH24:MI:SS''';
    select timestmp||'#'||country bulk collect into x_ret from viewdata where abs(timestmp-sysdate)*24*60*60 < diff;

end;
/


ALTER SESSION SET NLS_DATE_FORMAT = 'YYYY-MM-DD HH24:MI::SS';
select * from viewdata;





