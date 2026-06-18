#!/bin/bash
yum update -y
yum install -y httpd mariadb105-server php php-mysqlnd git
systemctl start httpd
systemctl enable httpd
systemctl start mariadb
systemctl enable mariadb
echo "<h1>Hello, I'm Michael!</h1>" > /var/www/html/index.html
