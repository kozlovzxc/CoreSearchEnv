## Installation

$ git clone --recursive https://github.com/kozlovzxc/CoreSearchEnv

$ cd CoreSearchEnv

* install ansible (https://docs.ansible.com/ansible/intro_installation.html)

## Writing inventory file

More info here https://docs.ansible.com/ansible/intro_inventory.html#host-variables.

* create and edit inventory file

$ cp inventory_sample inventory

$ cat my_inventory
~~~
[machines]
# structure
# {{some_random_name}} ansible_ssh_host={{host}} ansible_port={{host_ssh_port}} ansible_user={{host_user_username}} ansible_ssh_private_key_file={{path_to_ssh_priv_key}}
# you can find vagrant ssh port via `vagrant ssh-config`, usually it is 2222 or 2200 

# vagrant sample

test_trusty ansible_ssh_host=127.0.0.1 ansible_port=2200 ansible_user=vagrant ansible_ssh_private_key_file=./machines/ubuntu/trusty64/.vagrant/machines/default/virtualbox/private_key


# amazon sample
#amazon ansible_ssh_host=123.123.123.123 ansible_user=ubuntu ansible_ssh_private_key_file=~/.ssh/id_rsa
~~~

## How to up vagrant

* install virtualbox

* install vagrant. 

They should be in your disto repo. Alternative downloads https://www.vagrantup.com/downloads.html

Ubuntu 14.04 vagrant installation guide https://www.olindata.com/en/blog/2014/07/installing-vagrant-and-virtual-box-ubuntu-1404-lts

$ mkdir -p machines/ubuntu/trusty64  

$ cd machines/ubuntu/trusty64

$ vagrant init ubuntu/trusty64

$ ls
~~~
Vagrantfile
~~~

* uncomment private_network in Vagrantfile 
~~~
  config.vm.network "private_network", ip: "192.168.33.10" 
~~~
* uncomment memory settings
~~~
config.vm.provider "virtualbox" do |vb|
  #  # Display the VirtualBox GUI when booting the machine
  #  vb.gui = true
  #  
  #  # Customize the amount of memory on the VM:
    vb.memory = "1024"
  end
~~~

$ vagrant up
...

$ cd ../../..

## Running ansible
$ ansible-playbook -i inventory playbook.yml

## Settings to drop core dump
$ cd machines/ubuntu/vagrant

$ vagrant ssh

$ ulimit -c unlimited

$ echo "core.%p" | sudo tee /proc/sys/kernel/core_pattern

$ sudo service apache2 restart

## Visit wordpress site on 192.168.33.10
try to login with any login password, need it for core dump content.

## Drop core dump

$ ps aux | grep apache2 | tail -n +2 | head -n -1 | awk '{print $2}' | xargs -n1 sudo kill -11

$ ls /var/www/wordpress/cores/ \
core.7114  core.7115  core.7116  core.7117  core.7118

## Check all cores

$ for i in $(ls /var/www/wordpress/cores/core*); do sudo -u www-data check "$i";done 

~~~
searching:  NONCE_SALT  
 found NONCE_SALT : 
]+4U.!tY@xMC9+[D5-eqc~q-onk#y,n;NpQ5lf#d8t<xTPZnJA|t(EN{( <ZDv3T NONCE_SALT uk[* 4J5M)/wi~#25XFu(uD3`<5!r}OI)|YX@.7N9TKavJ53<Q>4+G/?q=X/(wzL WP_DEBUG wp-settings.php
searching:  AUTH_SALT   
 found AUTH_SALT :  
av9+V)5$@(p1yYKr(%#22(]tES*ZWhx5}i,!E=Rfnq#PCDER(,|p=j,J?UA[+9ia AUTH_SALT kP8_d9,f}Ie|T#*hCCKHCH1{i^85PlLrj=mG=QJQWtgxRbZpc(q3#@jtCv|3-{S7 SECURE_AUTH_SALT 8rS9-i-Kd9KKS9a5~-Mz G#z,qO?4i|r$h#N5->,3c_5kw(Jxj&S^[6=XF6<--)4
searching:  Apache_hosts_conf 
 found Apache_hosts_conf :                                                                                                                                           
CustomLog ${APACHE_LOG_DIR}/access.log combined SSLEngine on SSLCertificateFile /etc/apache2/ssl/apache.crt SSLCertificateKeyFile /etc/apache2/ssl/apache.key </VirtualHost> -- CustomLog ${APACHE_LOG_DIR}/access.log combined SSLEngine on SSLCertificateFile /etc/apache2/ssl/apache.crt SSLCertificateKeyFile /etc/apache2/ssl/apache.key </VirtualHost>
searching:  admin_username 
 did't found admin_username 
searching:  database_user                                                                                                                                                                       found database_user :       
sacred_arda DB_USER mighty_Manwe mighty_manwe DB_PASSWORD
searching:  ssl_key     
 did't found ssl_key                                                                                                                                                                           searching:  database_name        
 found database_name :
path DB_NAME sacred_Arda sacred_arda DB_USER
searching:  cookies_wp4                                                                                                                                                                         found cookies_wp4 :   
wp_user_settings /[^A-Za-z0-9=&_]/ wp-settings-time- /[^0-9]/ admin_url
searching:  admin_password 
 did't found admin_password   
searching:  cookies_wp3 
 found cookies_wp3 :               
TEST_COOKIE test_cookie wordpress_test_cookie COOKIEPATH cookiepath
searching:  cookies_wp2 
 found cookies_wp2 :
LOGGED_IN_COOKIE logged_in_cookie wordpress_logged_in_ TEST_COOKIE test_cookie
searching:  AUTH_KEY 
 found AUTH_KEY :
DB_COLLATE AUTH_KEY zn8oDPr9K~v7fapTkx*+(w$#s>6{bD1Fk1|-UpW!?WR|J(d$PUUlSXktjTZLYSIy SECURE_AUTH_KEY +kqJX}B8%os6.z5V]T-H7<PC|%byu?H]|^TA1C3<*|5hv(4sI`H7rXjs426-|L[m
searching:  cookies_wp1 
 did't found cookies_wp1 
searching:  LOGGED_IN_SALT 
 found LOGGED_IN_SALT :
8rS9-i-Kd9KKS9a5~-Mz G#z,qO?4i|r$h#N5->,3c_5kw(Jxj&S^[6=XF6<--)4 LOGGED_IN_SALT ]+4U.!tY@xMC9+[D5-eqc~q-onk#y,n;NpQ5lf#d8t<xTPZnJA|t(EN{( <ZDv3T NONCE_SALT uk[* 4J5M)/wi~#25XFu(uD3`<5!r}OI)|Y
X@.7N9TKavJ53<Q>4+G/?q=X/(wzL
...
~~~

## Extract private key 
$ cd ~/coreSearch

$ sudo -u www-data ./coreSearch.js --host=localhost --core=/var/www/wordpress/cores/core.2170
