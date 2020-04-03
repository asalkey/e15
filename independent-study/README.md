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

A playbook holds a set of tasks you would like to automate

 1. create a file playbook.yml
 example:
```
---
- hosts: webservers
  vars:
    http_port: 80
    max_clients: 200
  remote_user: root
  tasks:
  - name: ensure apache is at the latest version
    yum:
      name: httpd
      state: latest
  - name: write the apache config file
    template:
      src: /srv/httpd.j2
      dest: /etc/httpd.conf
    notify:
    - restart apache
  - name: ensure apache is running
    service:
      name: httpd
      state: started
  handlers:
    - name: restart apache
      service:
        name: httpd
        state: restarted
```
[information on what the file contains]

2. run the command ```ansible-playbook playbook.yml -f 10```

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
