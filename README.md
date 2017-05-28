## Installation

$ git clone --recursive https://github.com/kozlovzxc/CoreSearchEnv

$ cd CoreSearchEnv

* install ansible (https://docs.ansible.com/ansible/intro_installation.html)

## Writing inventory file

More info here https://docs.ansible.com/ansible/intro_inventory.html#host-variables.

* edit inventory file

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

// They should be in your disto repo. Alternative downloads https://www.vagrantup.com/downloads.html

// Ubuntu 14.04 vagrant installation guide https://www.olindata.com/en/blog/2014/07/installing-vagrant-and-virtual-box-ubuntu-1404-lts

$ mkdir -p machines/ubuntu/trusty64  

$ cd machines/ubuntu/trusty64

$ vagrant init ubuntu/trusty64

$ ls
~~~
Vagrantfile
~~~

* uncomment private_network in Vagrantfile \
~~~
  config.vm.network "private_network", ip: "192.168.33.10" \
~~~
* uncomment memory settings
~~~
config.vm.provider "virtualbox" do |vb| \
  #  # Display the VirtualBox GUI when booting the machine \
  #  vb.gui = true \
  #  \
  #  # Customize the amount of memory on the VM: \
    vb.memory = "1024" \
  end
~~~

$ vagrant up\
...

$ cd ../../..

## Running ansible
$ ansible-playbook -i inventory playbook.yml

## Visit wordpress site on 192.168.33.10
try to login with any login password, need it for core dump content.

## How to drop core dump
$ ulimit -c unlimited

$ echo "core.%p" | sudo tee /proc/sys/kernel/core_pattern

$ sudo service apache2 restart

$ ps aux | grep apache2 | tail -n +2 | head -n -1 | awk '{print $2}' | xargs -n1 sudo kill -11

$ ls /var/www/wordpress/cores/ \
core.7114  core.7115  core.7116  core.7117  core.7118

## Check all cores

$ for i in $(ls /var/www/wordpress/cores/core*); do sudo -u www-data check "$i";done 

## Extract private key 

$ sudo -u www-data ./coreSearch.js --host=localhost --core=/var/www/wordpress/cores/core.2170
