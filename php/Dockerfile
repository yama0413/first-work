FROM centos:6
RUN yum clean all
RUN yum update -y
RUN yum install -y epel-release
RUN yum install -y http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
RUN yum install -y httpd
RUN yum install -y --enablerepo=remi-php56 php php-devel php-mbstring php-pdo php-gd
COPY ./php.ini /etc/php.ini
COPY ./httpd.conf /etc/httpd/conf/httpd.conf
