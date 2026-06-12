
# Software Project Tracking System

## Degree Program
Bachelor of Software Engineering

## Group Number
Group 9

## Project Description
This project is a web-based Software Project Tracking System developed using PHP and MySQL.

The system allows users to:

- Register and login
- Record software projects
- View project status
- Search projects by name
- Manage project information

## Technologies Used

- PHP
- MySQL
- HTML
- CSS
- Git
- GitHub

## Github repository link

-https://github.com/Syntax2525/OpenSource_Assignment_SE_Group9


# Git Commands Used


## Initialize Git Repository

```bash
git init
```

## Check Repository Status

```bash
git status
```

## Add Files to Staging Area

```bash
git add .
```

## Create Commits

```bash
git commit -m "Initial project setup"
git commit -m "Implemented user registration module"
git commit -m "Implemented user login authentication"
git commit -m "Added project management features"
git commit -m "Added search and status update functionality"
```

## Connect Local Repository to GitHub

```bash
git remote add origin https://github.com/Syntax2525/OpenSource_Assignment_SE_Group9
```

## Push Code to GitHub

```bash
git push -u origin main
```

## Create Development Branch

```bash
git branch development
git checkout development
```

## Verify Available Branches

```bash
git branch
```

## Merge Development Branch into Main Branch

```bash
git checkout main
git merge development
```

## Push Updated Code to GitHub

```bash
git push origin main
```
# Installation Steps

## Prerequisites
mysql was installed in docker and docker version after installation is verified using windows commandline client as shown below
* PS C:\Users\mayenze> docker --version
Docker version 29.2.0, build 0b9d198
* PS C:\Users\mayenze> php -v
PHP 8.4.21 (cli) (built: May  6 2026 09:30:51) (NTS Visual C++ 2022 x64)
* PS C:\Users\mayenze> mysql --version
C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql.exe  Ver 8.0.46 for Win64 on x86_64 (MySQL Community Server - GPL)
* PS C:\Users\mayenze> git --version
git version 2.53.0.windows.1

## Clone Repository

```bash
git clone https://github.com/Syntax2525/OpenSource_Assignment_SE_Group9
```

## Navigate to Project Directory

```bash
cd OpenSource_Assignment_SE_Group9
```

## Configure Database

Create a MySQL database named:

```sql
project_tracking_db
```

Import the SQL file:

```bash
mysql -u root -p project_tracking_db < database/project_tracking.sql
```

## Start PHP Server

```bash
php -S localhost:8000
```

## Access Application

Open:

http://localhost:8000

