# Getting started with Ansible
Ansible is a server automation tool.

## Installing Ansible on Ubuntu
```
sudo apt update
sudo apt install software-properties-common
sudo apt-add-repository --yes --update ppa:ansible/ansible
sudo apt install ansible
```
[insert image of terminal]
[information on what each of above lines is for]

Line 1 -  updates the server and packages to the latest version

Line 2 -

Line 3 -

Line 4 -

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

## Resources
https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-ansible-on-ubuntu-18-04
https://www.digitalocean.com/community/tutorials/how-to-use-ansible-to-automate-initial-server-setup-on-ubuntu-18-04
https://docs.ansible.com/ansible/latest/index.html
