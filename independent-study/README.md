# Getting started with Ansible
Ansible is a server automation tool.

## Installing Ansible on Ubuntu
```
sudo apt-add-repository ppa:ansible/ansible
sudo apt update
sudo apt install ansible
```
The first line pulls in the ansible package onto the server. Second line updates all the packages and the last line installs ansible.

Once installed go into the newly created ansible folder:
```
cd /etc/ansible
```
Rename the hosts file:
```
mv hosts hosts.bk
```
This command will rename the default hosts file. A hosts file contains a list of all the servers you would like to manage using Ansible.

To create a new hosts file:
```
touch hosts
````
Edit the new hosts file:

```
nano hosts
```

Add the following to the new hosts file:
```
[local]
localhost ansible_connection=local
```
For now we only have one machine that we would like to manage.


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
