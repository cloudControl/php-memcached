cd /tmp
export LC_ALL="en_US.UTF-8"
locale-gen en_US.UTF-8

# libmemcache
apt-get install -y libsasl2-dev
wget https://launchpad.net/libmemcached/1.0/1.0.18/+download/libmemcached-1.0.18.tar.gz
tar -zxvf libmemcached-1.0.18.tar.gz
cd libmemcached-1.0.18
./configure
make
make install
cd ..

# php-memcached
apt-get install -y git
apt-get install -y php5-dev
apt-get install -y pkg-config

git clone /vagrant_data php-memcached
cd php-memcached

phpize
./configure
make

apt-get install -y php5-cli
#make test
