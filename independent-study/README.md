# Getting started with Ansible
Ansible is a server automation tool.

## Installing and configuring Ansible on Ubuntu
```
sudo apt-add-repository ppa:ansible/ansible
sudo apt update
sudo apt install ansible
```
The first line pulls in the Ansible package onto the server. Second line updates all the packages and the last line installs Ansible.

Once installed go into the newly created Ansible folder:
```
cd /etc/ansible
```
Rename the inventory file:
```
mv hosts hosts.bk
```
This command will rename the default inventory file that way there is a backup. An inventory file contains a list of all the servers you would like to manage using Ansible.

Next create a new inventory file:
```
touch hosts
````
Edit the new inventory file:

```
nano hosts
```

Add the following to the new inventory file:
```
[local]
localhost ansible_connection=local
```
1. ```[local]``` refers to the group name. Group names are not a requirement but provides originization if you have multiple servers you would like to put into different groups.

2. For now we only have one machine that we would like to manage. ```localhost``` is a variable name and ```ansible_connection``` is a behavorial inventory paramater that is assigned to the variable. We want to connect to our local machine so we set ```ansible_connection``` to ```local```.

Now we test our connection:
```
ansible all -m ping
```

The following output means everything is running smoothly:
```
localhost | SUCCESS => {
    "ansible_facts": {
        "discovered_interpreter_python": "/usr/bin/python"
    }, 
    "changed": false, 
    "ping": "pong"
}
```


## Creating a Playbook

A playbook holds a set of tasks you would like to automate. The example below will configure your server for a Laravel application.

Go into the root directory of the server ``` cd ~ ```

Create a playbook  ```touch laravel.yml```

* A playbook can be named anything but must end with the .yml extension. A playbook file can also be placed anywhere on the server.

Next, edit the laravel.yml file ```nano laravel.yml```

Add the following:
```
---
- hosts: local
```
* hosts refers to a server listed in the inventory file. Here we can either put the group name local or the server localhost 

Below that  we will add some tasks to install composer which is the package manager for Laravel
```
  tasks:
   - name: Download composer
     get_url:
      url: https://getcomposer.org/installer
      dest: /usr/local/bin

   - name: Install composer
     command: php installer
     args:
      chdir: /usr/local/bin

   - name: Rename composer executable
     command: mv composer.phar composer
     become: yes
     args:
      chdir: /usr/local/bin
```

* name is a brief description as to what the task is doing

* get_url is an Ansible module the downloads files. The ```url``` paramater has the url where the file is located. The ```dest``` paramater is where we want to place the file on the server.

* command is an ansible module that allows us to run commands. 

* args is a task keyword that allows us to pass additional parameters to the command module

* chdir is a paramater that tells Ansible to run the command in a specific directory. 

* become is a keyword that allows us to escalate privilage. This allows us to add sudo to the command we are running

Next we are going to add more memory to a server because composer is a resource hog. Add the following lines:

```
   - name: Create a swap file
     command: fallocate -l 4G /swapfile
     become: yes
     args:
      chdir: ~

   - name: Adjust swapfile permissions
     become: yes
     file:
      path: /swapfile
      owner: root
      group: root
      mode: '0600'

   - name: Setup the swap space
     command: mkswap /swapfile
     become: yes
     args:
      chdir: ~
      
   - name: Setup the swap space
     command: mkswap /swapfile
     become: yes
     args:
      chdir: ~

   - name: Enable swapfile
     command: swapon /swapfile
     become: yes
     args:
       chdir: ~

   - name: Add line to ensure swapfile is always enabled
     become: yes
     lineinfile:
      path: /etc/fstab
      line: /swapfile   none    swap    sw    0   0
      create: yes
```

* file is a module that allows us to manipulate files and file properties. The ```owner``` and ```group``` paramaters refers to the user and group that is assigned to the file or directory. The ```mode``` parameter refers to the permissions we would like to the directory or file to.

* lineinfile is a module that allows us to add a line to a file. The ```path``` paramater is the file we would like to add a line to. The line paramater is the line we would like to add. The ```create``` paramter creates the file if it does not exist.

Next we will want to add required modules to the server. Add the following lines below:

```
   - name: Add PHP repository
     command: add-apt-repository ppa:ondrej/php
     become: yes
     args:
       chdir: ~

   - name: Update all packages
     become: yes
     apt:
      update_cache: yes

   - name: Install packages
     become: yes
     apt:
      pkg:
       - php7.2-mbstring
       - zip
       - php7.2-xml
       - unzip

```

* apt is a module that allows us to manage apt packages. The update_cache paramater is equivalent to ```apt-get update```. The pkg paramater allows us to install the packages we need.

Lastly we will enable mod_rewrite and restart the server. Add the following:

```
   - name: Enable mod_rewrite for URL routes
     command: a2enmod rewrite
     become: yes
     args:
       chdir: ~

   - name: Restart server
     command: service apache2 restart
     become: yes
     args:
       chdir: ~
```

Now let's execute our Playbook

```
ansible-playbook laravel.yml
```

If everything is working correctly we should see no failed messages. If there are failed messages the output should tell you how to fix the issues before executing again.

## Playbook gotchas

Playbook files with extra whitespace, indentations, and tabs will give you an error when you  try to execute.

Install the following package to help you find issues with your playbook

```
apt install ansible-lint
```

To use simply run

```
ansible-lint laravel.yml
```

This will give you an output letting you know if there is anything wrong with the file.




## Resources
https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-ansible-on-ubuntu-18-04
https://www.digitalocean.com/community/tutorials/how-to-use-ansible-to-automate-initial-server-setup-on-ubuntu-18-04
https://docs.ansible.com/ansible/latest/index.html
