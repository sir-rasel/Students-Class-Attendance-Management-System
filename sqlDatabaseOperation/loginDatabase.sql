create database login_info;
use login_info;

create table institute_login(
    instituteCode varchar(30) not null primary key,
    instituteName varchar(100) not null,
    password varchar(100) not null
); 

create table teacher_login(
    UserID varchar(100) not null primary key,
    instituteCode varchar(30) not null,
    password varchar(100) not null
);

create table student_login(
    UserID varchar(100) not null primary key,
    instituteCode varchar(30) not null,
    password varchar(100) not null
);

create table register_student_info(
    userID varchar(100) not null primary key,
    instituteCode varchar(30) not null,
    studentName varchar(100) not null,
    studentDepartment varchar(30) not null,
    studentEmail varchar (100),
    studentMobile varchar (100)
);