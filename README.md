# OMBS - Online Medicine Bidding System
OMBS is a solution to prevent drug wastage and expiration. It is a smart commercial platform for pharmacies around the world to buy and purchase drugs, especially drugs that are nearing expiration date. The main motivation for establishing OMBS was environmental protection. Chemicals, plastics and other materials made from the decomposition of obsolete drugs can be dumped into the oceans. With OMBS, pharmacies can manage and track the course of treatment and trade it manually or automatically with other pharmacies that have a specific drug shortage.

> OMBS Uses `Laravel` , `Vuejs` , `Sass` , `Mysql`

# Screen shots

![Screen shots 1](/public/design/1.jpg?raw=true)
![Screen shots 2](/public/design/2.jpg?raw=true)
![Screen shots 3](/public/design/3.jpg?raw=true)
![Screen shots 4](/public/design/4.jpg?raw=true)


# Installation Guide

## 1. Database :

* Create a database with prefered name .
* Import `SQL` file from project root .

## 2. Env file :

* Rename the `.env.example` file to `.env` .
* Update database connection parameters in `.env` file .


### 3. Dependencies :

* In the project root run below commands to install required dependencies for backend and frontend .
  * `npm install`
  * `composer install`
    * After this command you need to run `php artisan key:generate` and put the key result in .env file (APP_KEY)


# Usage Guide

### 1. Backend :
* You can start running ombs backend with `php artisan serve` command

### 2. Frontend
* After changing anything related to frontend (e.g., Styles, Vuejs component) run `npm run dev`


# License

MIT License

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.