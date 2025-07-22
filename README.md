# Booklist PHP

Booklist PHP is a project to create a list of books to read. The aim is to hone basic PHP skills, OOP, PHP MySQL, PHP Web, PHP Composer, and PHPUnit. I am following a project created by [@ProgrammerZamanNow](https://www.youtube.com/@ProgrammerZamanNow) from the "Tutorial PHP" playlist (Todolist Application) and making a few improvisations.

## Tags

Booklist PHP has several tags, including:

### 1. 1.0.0

Booklist PHP uses only basic PHP.

### 2. 2.0.0

Booklist PHP has started using OOP concepts.

### 3. 2.1.1

Booklist PHP has started integrating with a database and has fixed several bugs in tags 2.1.0 (tags have been removed).

### 4. 2.2.1

Booklist PHP has started using Composer.

### 5. 3.0.0

Booklist PHP has a website interface, a router, and uses the MVC architecture with Service and Repository subclasses to avoid burdening the Controller.

## Get started with Booklist PHP

### A. Tags 1.0.0 - 2.2.1

### 1. Clone/Download Project
``` bash
git clone https://github.com/Tyn-Tian/Booklist-PHP.git
```
It's better to download according to the desired tags. [Link](https://github.com/Tyn-Tian/Booklist-PHP).

### 2. Run Project
``` bash
php ./App.php
```

**NB(Tags 2.1.1 - 2.2.1): Don't forget to create the database first. using booklist.sql**

### B. Tags 3.0.0

### 1. Clone Project
``` bash
git clone https://github.com/Tyn-Tian/Booklist-PHP.git
```

### 2. Create Database
use booklist.sql to create database.

### 3. Install Dependencies
``` bash
composer install
```

### 4. Run Project
``` bash
cd public
php -S localhost:8080
```

### 5. Tests Project (Optional)
``` bash
.\vendor\bin\phpunit .\tests\
```

## Features
- CRD booklists

## Assets

### 1. Architecture
![Architecture](/architecture.png)
