#!/bin/bash

# get the data
php crawl.php
# insert into database
mysql --user=$OPENSHIFT_MYSQL_DB_USERNAME --password=$OPENSHIFT_MYSQL_DB_PASSWORD --socket=$OPENSHIFT_MYSQL_DB_SOCKETollutantapi < sql_log.sql
# delete the sql_log
rm sql_log.sql
