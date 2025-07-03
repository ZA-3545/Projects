create database cars;
use cars;
create table cars(name varchar(15), model int, color varchar(10), chasenumber varchar(20), 
importyear int, brand varchar(9), price int, typeofcar varchar(11), stockquantity int);
create table customer(customername varchar(20), customerid varchar(8), contactnumber varchar(15),
email varchar(18), cnic varchar(16), gender varchar(7), dateofbirth varchar(13), address varchar(30));
create table salesperson(salespersonname varchar(20), salespersonid varchar(8), contactnumber varchar(15),
address varchar(30), email varchar(18), salary int, position varchar(35), cnic varchar(16));
create table showroom(location varchar(50), capcity int, numberofstaffs int, numberofcar int);
create table invoice(invoicename varchar(20), invoiceid varchar(8), customerid varchar(8),
salespersonid varchar(8), carchasenumber varchar(20), paymentstatus varchar(18), 
dateofpurchase varchar(9), totalamount int);
create table payment(paymentid varchar(8), invoiceid varchar(8), paymentmethod varchar(15),
paymentdate varchar(9));
create table booking(bookingid varchar(8), carchasenumber varchar(20), bookingpayment varchar(30),
carcolor varchar(10), bookingdate varchar(9), bookingstatus varchar(22));
create table supplier(supplierid varchar(20), suppliername varchar(8), contactnumber varchar(15),
email varchar(18), address varchar(30), suppliedcar int, suppliesbrandname varchar(25));
create table stock(stocknumber varchar(34), quantityofstock int , lastshipmentdate varchar(9), 
availabiltyofstock int);
create table admin(adminname varchar(23), userid varchar(45), password varchar(50), role varchar(54));
alter table cars modify chasenumber varchar(20) primary key;
insert into cars (name, model, color, chasenumber,importyear, brand, price, typeofcar, stockquantity) values ('Altas',24,'Black','ibn2024128',
2024,'Toyota',22000000,'car',50);
select * from cars;
alter table cars drop column importyear;
insert into cars (name, model, color, chasenumber, brand, price, stockquantity) values ('Civic',22,'White','ibn2022109','Honda',35000000,100);
select * from cars;
alter table customer modify customerid varchar(8) primary key;
insert into customer (customername, customerid, contactnumber,email, cnic, gender, dateofbirth, address) values
('Alina','f1025215','76543224','abc@gmail.com','234567789','Female','12-july','gulberg phase 3'),('Akbar','gh04645','76209324','adfc@gmail.com','234567789','Male','12-June','DHA phase 2');
select * from customer;
update  customer set customername='iqra', address='bharia block 1' where customerid='f102045';
alter table salesperson modify salespersonid varchar(8) primary key;
alter table salesperson drop column address;
insert into salesperson (salespersonname, salespersonid , contactnumber, email, salary, position, cnic) values ('Ahmad','sp5679','098765','tyoe@gmail.com',12000,'employee','35202875'),
('hamza','sp4567','345678','dfg@gmail.com',20000,'manager','98765498');
select * from salesperson;
 alter table showroom modify location varchar(50) primary key;
 insert into showroom (location, capcity, numberofstaffs, numberofcar) values ('johar-town',123500,6,156000);
 select * from showroom;
 alter table invoice modify invoiceid varchar(30) primary key;
 alter table invoice add returnamount int;
 insert into invoice (invoicename, invoiceid, customerid, salespersonid, carchasenumber, paymentstatus, dateofpurchase, totalamount, returnamount)
 values ('Umar','iv5257','gh04645','sp5679','ibn2022109','Done','9-april',3545605,500000),('Usman','iv5578','f102045','sp4567','ibn2024128','NO','9-april',0,0);
 select * from invoice;
 alter table payment modify paymentid varchar(30) primary key;
 alter table payment add paymenttime varchar(10);
 insert into payment(paymentid, invoiceid, paymentmethod, paymentdate, paymenttime) values ('py34576','iv5257','cash','23-jan','11:34'),('py36763','iv5578','card','12-feb','12:04');
 update payment set paymentmethod='debitcard' where paymentid='py34576';
 select * from payment;
 alter table booking modify bookingid varchar(28) primary key;
 alter table booking drop column bookingpayment;
 insert into booking(bookingid, carchasenumber, carcolor, bookingdate, bookingstatus) values 
('bi98735','f76543','grey','6-oct','not done'),('bi28347','uh8642','pink','31-dec','done');
select * from booking;
alter table supplier modify supplierid varchar(19) primary key; 
insert into supplier(supplierid, suppliername, contactnumber,email, address, suppliedcar, suppliesbrandname) values
('si54547','taha','74697320','ersp@gmail.com','new york',200,'nissan');
select * from supplier;
alter table supplier drop column email;
insert into supplier(supplierid, suppliername, contactnumber, suppliedcar, suppliesbrandname) values ('si29274','ibi','45678900',120,'mazda'),
('si0936','akbar','58587404',456,'gtr');
select * from supplier;
update supplier set address='pakistan' where supplierid='si0936';
alter table stock modify stocknumber varchar(35) primary key;
insert into stock (stocknumber, quantityofstock, lastshipmentdate, availabiltyofstock) values ('sn2095',2300,'8-sep',700),('sn67398',4500,'1-may',500); select * from stock; 
select * from stock;
alter table admin modify userid varchar(25) primary key;
alter table admin drop column role;
insert into admin(adminname, userid, password) values ('Alina','alina@3269','showroom65324');
insert into admin(adminname, userid) values ('jhom','jhon6786@5');
select * from admin; 
select * from admin where password is null;
update admin set password="12345" where userid='jhon6786@5';
select * from cars where price /2=11000000;
select * from cars where stockquantity +100=200;
select * from cars where model - 2=22; 
select * from customer where customerid %2=23456;
select * from customer where contactnumber *3=7859392;
select * from salesperson where salary -5600=14400;
select * from salesperson where salespersonid +6="sp4585";
select * from showroom where capcity /2=61750;
select * from showroom where numberofstaffs *2=12;
select * from showroom where numberofcar -56000=156000;
select * from invoice where totalamount *10=0;
select * from invoice where returnamount %2=250000;
select * from invoice where totalamount -5=3545600;
select * from payment where paymentid/5=3465; 
select * from payment where paymenttime +30=1205;
select * from booking where bookingid *2=56694;
select * from booking where carchasenumber %5=1728.4;
select * from supplier where suppliedcar +70=190;
select * from supplier where contactnumber/5=14939464;
select * from supplier where suppliedcar *9=4104;
select * from stock where quantityofstock -300=2000;
select * from stock where availabiltyofstock /2=250;
select * from admin where password %4=3086.25;
select * from admin where password +3=12348;



