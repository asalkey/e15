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

A playbook holds a set of tasks you would like to automate. The example below will configure your server and deploy a laravel application.

Go into the root directory of the server ``` cd ~ ```

Create a playbook  ```touch laravel.yml```

* A playbook can be named anything but must end with the .yml extension. A playbook file can also be placed anywhere on the server.

Next, edit the laravel.yml file ```nano laravel.yml```

Add the following:
```
---
- hosts: local
```
*hosts refers to a server listed in the inventory file. Here we can either put the group name local or the server localhost 

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

*name is a brief description as to what the task is doing
*get_url is an Ansible module the downloads files. The url paramater has the url where the file is located. The dest paramater is where we want to place the file on the server.
*command is an ansible module that allows us  to run commands. 
*args is a task keyword that allows us to pass additional parameters to the command module
*chdir is a paramater that tells Ansible to run the command in a specific directory. 
*become is a keyword that allows us to escalate privilage. This allows us to add sudo to the command we are running

Next we are going to add more memory to a server because composer is a resource hog. Add the following lines:




## Adding prompts to a Playbook

You may need to obtain user input.  

How to add user input:

```
---
- hosts: all
  vars_prompt:

    - name: username
      prompt: "What is your username?"
      private: no

    - name: password
      prompt: "What is your password?"

  tasks:

    - debug:
        msg: 'Logging in as {{ username }}'
        
```

## Adding files and changing permissions using a Playbook
https://docs.ansible.com/ansible/latest/modules/file_module.html

## Resources
https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-ansible-on-ubuntu-18-04
https://www.digitalocean.com/community/tutorials/how-to-use-ansible-to-automate-initial-server-setup-on-ubuntu-18-04
https://docs.ansible.com/ansible/latest/index.html
