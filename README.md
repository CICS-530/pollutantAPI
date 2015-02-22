# CICS 530 Project: 
[![Build Status](https://travis-ci.org/achengscode/pollutantAPI.svg?branch=master)](https://travis-ci.org/achengscode/pollutantAPI)
[![Code Climate](https://codeclimate.com/github/achengscode/pollutantAPI/badges/gpa.svg)](https://codeclimate.com/github/achengscode/pollutantAPI)
[![Test Coverage](https://codeclimate.com/github/achengscode/pollutantAPI/badges/coverage.svg)](https://codeclimate.com/github/achengscode/pollutantAPI)

## Pollutant DB API

This is the pollutant web API part of the CICS 530 project. This portion is the 
part that stores information about the categories of diseases and makes 
simple queries dealing with each of the following models:
	* Categories (The disease categories)
	* Diseases (The diesases themselves)
	* Toxins (The toxins that are attributed to the diseases).

The capabilities of this API is quite limited. There is no ability to ADD to the
database for now, it is merely just a querying service. Addition of real-time
air pollution data may come in the future.

Only GET requests are supported for now.

## Development and Deployment
This project is developed using CakePHP version 2.6. 
Continuous integration is maintained via Travis-CI and CodeClimate (both of which are
free for open source projects).

Unit tests have been created using PHPUnit.

The folder structure follows the standard CakePHP folder structure; one bug is 
noted, all third-party plugins installed via Composer must be copied over to the 
`app/Vendor` folder before it can be used.

The supported PHP versions are 5.2.8+, although the lastest version of PHP is
recommended. 

A MySQL database is required for this application. The database is currently located 
in the form of various SQL scripts; this will change in the future, the SQL needs
to be migrated over to a database-agnostic form (i.e. in the form of schema.php).
