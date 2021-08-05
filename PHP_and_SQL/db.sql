DROP TABLE db_parm;
DROP table db_data;

CREATE TABLE db_parm (
    id varchar(10) primary key not null,
    name varchar(40) not null,
    units varchar(20)not null
);

CREATE TABLE db_data (
    id int primary key auto_increment,
    t DATE not null,
    parameterid varchar(10) not null,
	reading float not null,
	FOREIGN KEY (parameterid) REFERENCES db_parm(id)
);

Insert into db_parm (id, name, units) 
   values ('FLOWE', 'Water Flow Location EAST Channel', 'm3/day');
Insert into db_parm (id, name, units) 
   values ('FLOWW', 'Water Flow Location WEST Channel', 'm3/day');
Insert into db_parm (id, name, units) 
   values ('FLOWB', 'Water Flow Location EAST ByPass', 'm3/day');
Insert into db_parm (id, name, units) 
   values ('TEMP', 'Temperature' , 'deg C');
   
Insert into db_data (id,t,parameterid,reading) 
values ('1','2019-01-01','FLOWE','1291.4');
Insert into db_data (id,t,parameterid,reading) 
values ('2','2019-01-02','FLOWE','1428.4');
Insert into db_data (id,t,parameterid,reading) 
values ('3','2019-01-03','FLOWE','1227.5');
Insert into db_data (id,t,parameterid,reading) 
values ('4','2019-01-04','FLOWE','1161.1');
Insert into db_data (id,t,parameterid,reading) 
values ('5','2019-01-01','FLOWW','296.6');
Insert into db_data (id,t,parameterid,reading) 
values ('6','2019-01-02','FLOWW','248.4');
Insert into db_data (id,t,parameterid,reading) 
values ('7','2019-01-03','FLOWW','0');
Insert into db_data (id,t,parameterid,reading) 
values ('8','2019-01-04','FLOWW','327.8');
Insert into db_data (id,t,parameterid,reading) 
values ('9','2019-01-01','TEMP','5.4');
Insert into db_data (id,t,parameterid,reading) 
values ('10','2019-01-02','TEMP','5.4');
Insert into db_data (id,t,parameterid,reading) 
values ('11','2019-01-03','TEMP','5.2');
Insert into db_data (id,t,parameterid,reading) 
values ('12','2019-01-04','TEMP','5.1');

