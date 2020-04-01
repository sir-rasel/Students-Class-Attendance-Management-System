create database login_info;
use login_info;

create table institute_login(
    instituteCode varchar(30) not null primary key,
    instituteName varchar(100) not null,
    password varchar(100) not null
);insert 

create table teacher_login(
    instituteCode varchar(30) not null primary key,
    teacherName varchar(100) not null,
    password varchar(100) not null
);

create table student_login(
    instituteCode varchar(30) not null primary key,
    studentName varchar(100) not null,
    password varchar(100) not null
);