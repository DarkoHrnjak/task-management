# Usefull commands

## 1. Doctrine

#### 1. Create Database
When setting up project, there will be no database. To create database run this
```sh
bin/console doctrine:database:create
```

#### 2. After making changes to entity (adding new entity/changing fields, etc..)
Run this to apply those changes to the actual database
```sh
bin/console doctrine:schema:update --force --complete
```


#### 2. Insert data/fixtures
To insert data from fixtures run this command 
(it will delete everything from database and insert data from fixtures) 
```sh
bin/console doctrine:fixtures:load
```


## 2. Other usefull info

#### 1. database info inside .env
Here is explanation of each parameter and its example.

Explanation:
```sh
DATABASE_URL="{driver}://{database_user}:{database_password}@{db_host}:{db_port}/{db_name}?serverVersion=8.0.32&charset=utf8mb4"
```
Example:
```sh
DATABASE_URL="mysql://root:password@127.0.0.1:3306/TaskFlow?serverVersion=8.0.32&charset=utf8mb4"
```


