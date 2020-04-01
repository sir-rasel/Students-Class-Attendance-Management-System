create database loginInfo;
use database loginInfo;

create table instituteLogin(
    instituteCode varchar(30) not null primary key,
    instituteName varchar(100) not null,
    password varchar(100) not null
);

create table teacherLogin(
    instituteCode varchar(30) not null primary key,
    teacherName varchar(100) not null,
    password varchar(100) not null
);

create table studentLogin(
    instituteCode varchar(30) not null primary key,
    studentName varchar(100) not null,
    password varchar(100) not null
);